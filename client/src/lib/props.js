import { dataStore } from '../stores/dataStore'
import { plateStore } from '../stores/plateStore'
import { widgetStore } from '../stores/widgetStore'
import { sumDataStore } from '../stores/sumDataStore'
import { fullDataStore } from '../stores/fullDataStore'

export default class propHandler {

    data = {
        'totalCost':0,
        'totalDistance':0,
        'costMonth':0,
        'distanceMonth':0,
        'odometerStop':0,
        'licensePlate':'abc123',
        'travelTime':0,
        type: {
            'privat':0,
            'tjanst':0
        }
    }

    newSearch() {
        dataStore.set({'data':[]})
        widgetStore.set([])
        plateStore.set('')
        sumDataStore.set([])
        fullDataStore.set([])
        
    this.data = {
        'totalCost':0,
        'totalDistance':0,
        'costMonth':0,
        'distanceMonth':0,
        'odometerStop':0,
        'licensePlate':'abc123',
        'travelTime':0,
        type: {
            'privat':0,
            'tjanst':0
        }
    }
    }

    recordData(data,plate) {
        this.allData = data
        this.plateNumber = plate
        this.formatData()
    }

    formatData() {
        let totalCost = 0
        let totalDistance = 0
        let currentMonth = ''
        let allCosts = []
        let totalSeconds
        let type = {
            'privat':0,
            'tjanst':0,
            'kund':0,
            'annat':0
        }
        let graphData = this.allData.data
        graphData.forEach((data,i) => {
            // First month
            if(currentMonth.length === 0) {
                currentMonth = data.timeStart.split(' ')[1]
                console.log('Månad: ', currentMonth)
            }
            
            // Month change
            if(currentMonth != data.timeStart.split(' ')[1]) {
                let obj = {
                    'month':currentMonth,
                    'cost':totalCost,
                    'distance':totalDistance,
                    'type':type
                }
                allCosts.push(obj)
                totalCost = 0
                totalDistance = 0
                currentMonth = data.timeStart.split(' ')[1]
            }
            // Last month
            if(graphData.length === i+1) {
                let obj = {
                    'month':currentMonth,
                    'cost':totalCost,
                    'distance':totalDistance,
                    'type':type
                }
                allCosts.push(obj)
            }
            let intx = parseInt(data.odometerStop)
            let inty = parseInt(this.data.odometerStop)
            if(intx > inty) this.data.odometerStop = intx
            totalCost += parseFloat(data.cost)
            totalDistance += parseFloat(data.distance)
            if(data.routeType === 'Tjänsteres') type.tjanst++
            if(data.routeType === 'Privatresa') type.privat++
            if(data.routeType === 'Kundresa') type.kund++
            if(data.routeType === '2' && data.routeType === '5') type.annat++
            this.data.type = type
            this.travelTime += data.travelTime
            this.data.licensePlate = data.licensePlate
            let time = data.travelTime.split(':')
            let seconds = parseInt((+time[0]) * 60 * 60 + (+time[1]) * 60 + (+time[2]))
            this.data.travelTime += seconds
            
        })
        let measuredTime = new Date(null)
        measuredTime.setSeconds(this.data.travelTime)
        this.data.travelTime = measuredTime.toISOString().substr(11, 8)
        widgetStore.set(allCosts)
        this.setTotalCost(allCosts)
        this.setTotalDistance(allCosts)
        this.setCostMonth(allCosts)
        this.setDistanceMonth(allCosts)
        sumDataStore.set([this.data])
        console.log(this.data)
    }

    setCostMonth(dataArr) {
        let costMonth = []
        dataArr.forEach(item => {
            costMonth.push({
                'month':item.month,
                'cost': item.cost
            })
        })
        this.data.costMonth = costMonth
    }

    setDistanceMonth(dataArr) {
        let distanceMonth = []
        dataArr.forEach(item => {
            distanceMonth.push({
                'month':item.month,
                'distance': item.distance
            })
        })
        this.data.distanceMonth = distanceMonth
    }

    setTotalDistance(dataArr) {
        let totalDistance = 0
        dataArr.forEach(item => {
            totalDistance += item.distance
        })
        this.data.totalDistance = parseFloat(totalDistance)
    }

    setTotalCost(dataArr) {
        let totalCost = 0
        dataArr.forEach(item => {
            totalCost += parseFloat(item.cost)
        })
        this.data.totalCost = totalCost
    }

    getAllData() {
        return this.data
    }
}
