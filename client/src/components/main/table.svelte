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
        font-size: 15px;
    }

    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        max-height: 100%;
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
        text-align: left;
        background-color: #04aa6d;
        color: white;
    }

    th {
        position: sticky;
        top: -1px;
        height: 10px;
    }
</style>
