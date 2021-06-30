<script>
    import { dataStore } from '../../stores/dataStore'
    import { onMount } from 'svelte'
    import Chart from 'chart.js/auto'

    let ctx
    let chart
    let graphData
    let priv = 1
    let job = 1

    onMount(() => {
        chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [`Privatresor: ${priv}`, `Tjänsteresor: ${job}`],
                datasets: [{
                    label: 'Bensinkostnad för varje månad',
                    data: [1], // Hämta data från mysql
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        })
    })

    dataStore.subscribe(data => {
        console.log('in sub')
        graphData = data.data
        graphData.forEach(data => {
            if(data.routeType === 'Privatresa') priv++ 
            if(data.routeType === 'Tjänsteres') job++
            chart.data.datasets[0].data[0] = priv
            chart.data.datasets[0].data[1] = job
            chart.data.labels = [`Privatresor: ${priv}`, `Tjänsteresor: ${job}`]
            chart.update()
        })
    })
</script>


<canvas id="myChart" bind:this={ctx}></canvas>

<style>
</style>