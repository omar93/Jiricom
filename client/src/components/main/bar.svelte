<script>
    import { widgetStore } from '../../stores/widgetStore'
    import { dataStore } from '../../stores/dataStore'
    import Chart from 'chart.js/auto'
    import { onMount } from 'svelte'

    let ctx
    let chart

    let graphData
    let totalCost = 0
    let totalDistance = 0
    let currentMonth = ''
    let allCosts = []

    onMount(() => {
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Juni','Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Bensinkostnad för varje månad',
                    data: 
                    [120, 19, 3, 5, 2, 3]
                    ,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })

    dataStore.subscribe(data => {
        allCosts = []
        totalCost = 0
        currentMonth = ''
        graphData = data.data
        graphData.forEach((data,i) => {

            // First month
            if(currentMonth.length === 0) {
                currentMonth = data.timeStart.split(' ')[0]
            }

            // Month change
            if(currentMonth != data.timeStart.split(' ')[0]) {
                let obj = {
                    'month':currentMonth,
                    'cost':totalCost,
                    'distance':totalDistance
                }
                allCosts.push(obj)
                totalCost = 0
                totalDistance = 0
                currentMonth = data.timeStart.split(' ')[0]
            }
            // Last month
            if(graphData.length === i+1) {
                let obj = {
                    'month':currentMonth,
                    'cost':totalCost,
                    'distance':totalDistance
                }
                allCosts.push(obj)
            }
            
            totalCost += parseFloat(data.cost)
            totalDistance += parseFloat(data.distance)

        })
        widgetStore.set(allCosts)

    })

    widgetStore.subscribe(data => {
        console.log('price store: ', data)
        let month = data.map(item => item.month)
        let cost = data.map(item => item.cost)
        if(allCosts.length > 0) {
            chart.reset()
            chart.data.labels = [...month]
            chart.data.datasets[0].data = [...cost]
            chart.update()
        }
    })
</script>


<canvas id="myChart" bind:this={ctx} width="400"></canvas>

<style>
    #myChart {
        height: 100%;
    }
</style>