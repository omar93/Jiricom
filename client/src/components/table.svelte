<script>
    import { plateStore } from '../stores/plateStore'
    import { pageStore } from '../stores/pageStore'
    import { createEventDispatcher } from 'svelte'
    import dbHandler from '../lib/database'
	import Modal from './modal.svelte'

    export let items = []
    
    let db = new dbHandler()
    let showModal = false
    let offset = 0
    const dispatch = createEventDispatcher()
    let plate =  plateStore

    pageStore.subscribe(data => offset = data)
    plateStore.subscribe(data => plate = data)

    const rowClicked = e => {
        let startAddress = e.path[1].cells[6].textContent
        let stopAddress = e.path[1].cells[7].textContent
        // showModal = true
    }

    const handleClickIncrease = async _ => {
        offset += 13
        pageStore.set(offset)
        let data = await db.getSingleItem(`http://localhost/jiricom/server/api/route/readSingle.php?licensePlate=${plate}&offset=${offset}`)
        dispatch('newPage', data)
    }

        const handleClickDecrease = async _ => {
        offset -= 13
        pageStore.set(offset)
        let data = await db.getSingleItem(`http://localhost/jiricom/server/api/route/readSingle.php?licensePlate=${plate}&offset=${offset}`)
        dispatch('newPage', data)
    }

</script>
    <Modal bind:showModal></Modal>
    <div class="tableContainer">
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
            {#if items.length != 0}
            {#each items as item}
                <tr on:click={rowClicked}>
                    {#each Object.values(item) as [...columnItem] }
                        <td>{columnItem}</td>
                    {/each}
                </tr>
            {/each}
            {/if}
        </table>
        {#if items.length != 0}
            
        
        <div class="buttonContainer">
            <button on:click={() => handleClickDecrease()}>←</button>
            <span>{offset/13}</span>
            <button on:click={() => handleClickIncrease()}>→</button>
            <!-- button on:click={sortTable}> → </button> -->
        </div>
{/if}
    </div>

    

<style>
    .tableContainer {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
#customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    max-height: 100%;
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

th {
    position: sticky;
    top: 0; /* Don't forget this, required for the stickiness */
    padding: 20px;
    height: 30px;
}

</style>