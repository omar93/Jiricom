<script>
    import { dataStore } from "../../stores/dataStore"

    let items = []
    let mockItems = [
        'timeStart',
        'timeEnd',
        'distancest',
        'travelTime',
        'startAddress',
        'stopAddress'
    ]

    let cell = 'cell'
    dataStore.subscribe(data => items = data.data)

</script>

<div class="tableContainer">
    <table id="customers">
        {#if items.length != 0}
            <tr>
                {#each [...Object.keys(items[0])].slice(2, 8) as key}
                    <th> {key} </th>
                {/each}
            </tr>
        {:else}
        <tr>
            {#each mockItems as head}
                <th>{head}</th>
            {/each}
        </tr>
        {/if}

        {#if items.length != 0}
            {#each items as item}
                <tr>
                    {#each [...Object.values(item)].slice(2, 8) as [...columnItem]}
                        <td>{columnItem}</td>
                    {/each}
                </tr>
            {/each}
        {:else}
        
            {#each {length:8} as apa}
            <tr>
                {#each mockItems as item}
                    <td>{item}</td>
                {/each}
            </tr>
                
            {/each}
        {/if}
    </table>
</div>

<style>
    *{
        font-size: 15px;
    }

    .tableContainer {
        width: 95%;
        max-height: 95%;
        overflow-y: scroll;
    }

    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        padding-top: 10px;
        padding-bottom: 10px;
        font-size: 0.85em;
        border: 1px solid #ddd;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 15px;
        padding-bottom: 15px;
        background-color: #04aa6d;
        color: white;
        padding-left: 10px;
        padding-right: 10px;
    }

    th {
        position: sticky;
        top: -1px;
        height: 10px;
    }
</style>
