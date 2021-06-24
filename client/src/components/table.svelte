<script>
	import Modal from './modal.svelte'

    export let items = []
    
    let showModal = false

    const rowClicked = e => {
        let startAddress = e.path[1].cells[6].textContent
        let stopAddress = e.path[1].cells[7].textContent
        showModal = true
    }

function sortTable() {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("customers")
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
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
            <button> ← </button>
            <span>1/5</span>
            <button on:click={sortTable}> → </button>
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