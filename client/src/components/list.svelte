<script>
    import { onMount } from 'svelte'
    export let items = []

    let url = 'http://localhost/jiricom/server/api/route/read.php'

    onMount(async () => {
        try {
            let req = await fetch(url)
            let data = await req.json()
            items = data.data
        } catch(err) {
            console.log(err)
        }
    }) 

    const rowClicked = e => {
        let startAddress = e.path[1].cells[6].textContent
        let stopAddress = e.path[1].cells[7].textContent
    }
</script>

    <table id="customers">
        <tr>
            <th>routeId</th>
            <th>licensePlate</th>
            <th>timeStart</th>
            <th>timeEnd</th>
            <th>distance</th>
            <th>travelTime</th>
            <th>startAddress</th>
            <th>stopAddress</th>
            <th>routeTtype</th>
            <th>litres</th>
            <th>cost</th>
            <th>firstLat</th>
            <th>firstLon</th>
            <th>lastLat</th>
            <th>lastLon</th>
            <th>odometerStop</th>
            <th>odometerStart</th>
        </tr>

        <!--
            the outer loop is for looping over the array 
            of json objects returned from the DB

            the inner loops over each value for the key pair and uses the spread
            operator for each value and created a 'td' for each one.
        -->
        {#each items as item}
            <tr on:click={rowClicked}>
                {#each Object.values(item) as [...columnItem] }
                    <td>{columnItem}</td>
                {/each}
            </tr>
        {/each}
    </table>


<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>