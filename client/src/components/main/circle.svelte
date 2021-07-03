<script>
    import { korvStore } from '../../stores/korvStore'
    import { onMount } from 'svelte'
    import Chart from 'chart.js/auto'

    let ctx
    let chart

    onMount(() => {
        chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [`Resetyper`],
                datasets: [{
                    label: 'Resetyper',
                    data: [1], // Hämta data från mysql
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
                },
            }
        })
        korvStore.subscribe(data => {
            if(data.length > 0) {
                chart.data.datasets[0].data[0] = data[0].type.privat
                chart.data.datasets[0].data[1] = data[0].type.tjanst
                chart.data.datasets[0].data[2] = data[0].type.kund
                chart.data.datasets[0].data[3] = data[0].type.annat
                chart.data.labels = [`Privatresor: ${data[0].type.privat}`, `Tjänsteresor: ${data[0].type.tjanst}`, `Kundresor ${data[0].type.kund}`, `Annat ${data[0].type.annat}`]
                chart.update()
            }
        })
    })


</script>


<canvas id="myChart" bind:this={ctx}></canvas>

<style>
</style>