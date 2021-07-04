<script>
    import { dataStore } from "../../stores/dataStore"
    import{ onMount } from 'svelte'

    let items = []
    let current = 0
    let offset = 7
    let pages = 0
    let totalPages = 0
    let table,h
    let mockItems = [
        'timeStart',
        'timeEnd',
        'distance',
        'travelTime',
        'startAddress',
        'stopAddress'
    ]
    dataStore.subscribe(data => {
        if(data.data.length > 0) {
            pages = 1
            totalPages = Math.round((data.data.length/7)+1)
            items = data.data.slice(current,offset)
        }
    })

    onMount(() => {
        h = (table.parentElement.clientHeight / 15)-2
        // console.log(h)
    })

    const handleRight = () => {
        if(pages < totalPages) {
            pages++
            current = offset
            offset += 7
            dataStore.subscribe(data => {
                items = data.data.slice(current,offset)
                // console.log(items)
            })
        }

    }
    const handleLeft = () => {
        if(pages > 1) {
            pages--
            offset = current
            current -= 7
            dataStore.subscribe(data => {
                items = data.data.slice(current,offset)
                // console.log(items)
            })
        } else {
            alert('no more data')
        }

    }

    const changePage = () => {
        // console.log('Current page: ', pages)
        current = 0
        offset = 7
        current += 1 + (7 * parseInt(pages))
        offset += 1 + (7 * parseInt(pages))
        dataStore.subscribe(data => {
                items = data.data.slice(current,offset)
                // console.log(items)
            })
    }

</script>

<div class="tableContainer" bind:this={table}>
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
                        <td style="height: {h}px;">{columnItem}</td>
                    {/each}
                </tr>
            {/each}
        {:else}
        
            {#each {length:7} as nothing}
            <tr>
                {#each mockItems as item}
                    <td style="height: {h}px;">{item}</td>
                {/each}
            </tr>
                
            {/each}
        {/if}
    </table>
    <div class="bottomContainer">
        <span on:click={handleLeft}>ᐊ</span>
        {#if pages > 0}
            <input type="text" bind:value={pages} on:change={changePage}>
        {:else}
            <span>{pages}</span>
        {/if}
        /
        <span>{totalPages}</span>
        <span on:click={handleRight}>ᐅ</span>
    </div>
</div>

<style>
    *{
        font-size: 15px;
    }

    input[type=text] {
        width: 50px;
        font-size: 25px;
        height: 25px;
        margin-top: 10px;
        text-align: center;
    }

    .bottomContainer {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
        margin-top: 10px;
        gap: 20px;
    }

    span {
        font-size: 25px;
    }

    span:hover {cursor: pointer;}

    .tableContainer {
        width: 97%;
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
