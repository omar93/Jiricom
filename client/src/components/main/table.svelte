<script>
    import { sortTableByColumn } from '../../lib/sortingTable'
    import { fullDataStore } from '../../stores/fullDataStore'
    import { sumDataStore } from '../../stores/sumDataStore'
    import { dataStore } from '../../stores/dataStore'
    import { createEventDispatcher } from 'svelte'
    import{ onMount } from 'svelte'

    const dispatch = createEventDispatcher()

    let items = []
    let fullData,sumData
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
            items = data.data
        }
    })

    onMount(() => {
        h = (table.parentElement.clientHeight / 14)
        document.querySelectorAll(`th`).forEach(headerCell => {
            console.log(headerCell)
            headerCell.addEventListener("click", () => {
                const tableElement = headerCell.parentElement.parentElement.parentElement
                const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell)
                const currentIsAscending = headerCell.classList.contains('th-sort-asc')
                sortTableByColumn(tableElement, headerIndex, !currentIsAscending)
            })
        })
    })

    const handleClick = (e) => {
        let routeId = e.path[1].classList[0]
        let currentRoute = items.find(route => route.routeId === routeId)
        fullDataStore.set(currentRoute)
        dispatch('showModal')
    }
</script>

<div class="tableContainer" bind:this={table}>
    <table id="customers">
        {#if items.length != 0}
        <thead>
            <tr>
                {#each [...Object.keys(items[0])].slice(2, 8) as key}
                    <th> {key} </th>
                {/each}
            </tr>
            </thead>
        {:else}
        <tr>
            {#each mockItems as head}
                <th>{head}</th>
            {/each}
        </tr>
        {/if}

        {#if items.length != 0}
        <tbody>
            {#each items as item}
                <tr class="{item.routeId}">
                    {#each [...Object.values(item)].slice(2, 8) as [...columnItem]}
                        <td style="height: {h}px;" on:click={handleClick}>{columnItem}</td>
                    {/each}
                </tr>
            {/each}
        </tbody>
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
</div>

<style>
    *{
        font-size: 15px;
    }

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
        cursor: pointer;
    }

    td {
        cursor: pointer;
    }
</style>
