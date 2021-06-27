<script>
    import { dataStore } from '../../stores/dataStore'
    import Chart from 'chart.js/auto'

    let ctx
    let myChart
    let graphData
    let priv = 0
    let job = 0

    dataStore.subscribe(data => {
        graphData = data.data
        graphData.forEach(data => {
            if(data.routeType === 'Privatresa') priv++ 
            if(data.routeType === 'Tjänsteres') job++ 
        });
        if(graphData.length != 0) {
            new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Privatresa', 'Tjänstresa'],
                datasets: [{
                    label: 'Bensinkostnad för varje månad',
                    data: [priv, job], // Hämta data från mysql
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
                }
            }
        });
        }
    })

</script>


<canvas id="myChart" bind:this={ctx}>

</canvas>

<style>
</style>