<script>
    import { dataStore } from '../../stores/dataStore'
    import Chart from 'chart.js/auto'
    import { onMount } from 'svelte'

    let ctx

    let graphData
    let totalCost = 0

    dataStore.subscribe(data => {
        graphData = data.data
        graphData.forEach(data => {
            console.log(data)
            totalCost += parseFloat(data.cost)
        })
        console.log(`Total Bensin kostnad: ${Math.round(totalCost)}kr`)
    })
    
    onMount(() => {
    new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Juni','Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
        datasets: [{
            label: 'Bensinkostnad för varje månad',
            data: [12, 19, 3, 5, 2, 3], // Hämta data från mysql
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


<canvas id="myChart" bind:this={ctx}>

</canvas>

<style>
</style>