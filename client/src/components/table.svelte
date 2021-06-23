<script>
    import { onMount } from 'svelte'
	import Modal from './modal.svelte'

    export let items = []
    let showModal = false

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
        showModal = true
    }
</script>
    <Modal bind:showModal>
        
    </Modal>
    <table id="customers">
        <tr>
            <th>rutt ID</th>
            <th>Registreringsnummer</th>
            <th>starttid</th>
            <th>sluttid</th>
            <th>Sträcka(KM)</th>
            <th>resetid</th>
            <th>från</th>
            <th>till</th>
            <th>resetyp</th>
            <th>liter</th>
            <th>pris</th>
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
    padding-top: 12px;
    padding-bottom: 12px;
    font-size: 0.85em;
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