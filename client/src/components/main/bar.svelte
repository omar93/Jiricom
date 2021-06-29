<script>
    import { priceStore } from '../../stores/priceStore'
    import { dataStore } from '../../stores/dataStore'
    import Chart from 'chart.js/auto'
    import { onMount } from 'svelte'

    let ctx
    let chart

    let graphData
    let totalCost = 0
    let currentMonth
    let prevMonth
    let allCosts = []

    dataStore.subscribe(data => {
        graphData = data.data
        graphData.forEach(data => {
            currentMonth = data.timeStart.split(' ')[0]
            if(currentMonth != prevMonth) {
                let obj = {
                    'month':prevMonth,
                    'cost':totalCost
                }
                allCosts.push(obj)
                totalCost = 0
                currentMonth = ''
            }
            totalCost += parseFloat(data.cost)
            prevMonth = data.timeStart.split(' ')[0]
        })
        priceStore.set(allCosts)
    })

    priceStore.subscribe(data => {
        let month = data.map(item => item.month)
        let cost = data.map(item => item.cost)
        console.log(data)
        if(allCosts.length > 0) {
            chart.data.labels = [...month]
            chart.data.datasets[0].data = [...cost]
            chart.update()
        }

    })

    
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
            borderWidth: 1
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

</script>


<canvas id="myChart" bind:this={ctx} width="400"></canvas>

<style>
    #myChart {
        height: 100%;
    }
</style>