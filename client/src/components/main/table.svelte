<script>
    import { dataStore } from "../../stores/dataStore"

    let items = []
    dataStore.subscribe(data => items = data.data)

</script>

<div class="tableContainer">
    <table id="customers">
        {#if items.length != 0}
            <tr>
                {#each [...Object.keys(items[0])].slice(2, 11) as key}
                    <th> {key} </th>
                {/each}
            </tr>
        {/if}

        {#if items.length != 0}
            {#each items as item}
                <tr>
                    {#each [...Object.values(item)].slice(2, 11) as [...columnItem]}
                        <td>{columnItem}</td>
                    {/each}
                </tr>
            {/each}
        {/if}
    </table>
</div>

<style>
    *{
        font-size: 13px;
    }
    .tableContainer {
        padding: 20px;
        display: grid;
        grid-template-rows: 90% 10%;
        grid-template-columns: 1fr;
        grid-template-areas:
        "table";
    }

    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        max-height: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding-top: 12px;
        padding-bottom: 12px;
        font-size: 0.85em;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04aa6d;
        color: white;
    }

    th {
        position: sticky;
        top: 0;
        padding: 10px;
        height: 10px;
    }
</style>
