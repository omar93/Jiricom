<script>
    import { plateStore } from "../stores/plateStore";
    import { pageStore } from "../stores/pageStore";
    import { createEventDispatcher } from "svelte";
    import dbHandler from "../lib/database";
    import Modal from "./modal.svelte";

    export let items = [];

    let db = new dbHandler();
    let showModal = false;
    let offset = 0;
    let limit = 17;
    let plate = plateStore;

    const dispatch = createEventDispatcher();

    pageStore.subscribe((data) => (offset = data));
    plateStore.subscribe((data) => (plate = data));

    const rowClicked = (e) => {
        let startAddress = e.path[1].cells[6].textContent;
        let stopAddress = e.path[1].cells[7].textContent;
        // showModal = true
    };

    const handleClickIncrease = async (_) => {
        offset += 17;
        pageStore.set(offset);
        let data = await db.getSingleItem(
            `http://localhost/jiricom/server/api/route/readSingle.php?licensePlate=${plate}&offset=${offset}&limit=${limit}`
        );
        dispatch("newPage", data);
    };

    const handleClickDecrease = async (_) => {
        offset -= 17;
        pageStore.set(offset);
        let data = await db.getSingleItem(
            `http://localhost/jiricom/server/api/route/readSingle.php?licensePlate=${plate}&offset=${offset}&limit=${limit}`
        );
        dispatch("newPage", data);
    };
</script>

<Modal bind:showModal />
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
                <tr on:click={rowClicked}>
                    {#each [...Object.values(item)].slice(2, 11) as [...columnItem]}
                        <td>{columnItem}</td>
                    {/each}
                </tr>
            {/each}
        {/if}
    </table>

    {#if items.length != 0}
        <div class="buttonContainer">
            <button on:click={() => handleClickDecrease()}>←</button>
            <span>{offset / 17 + 1}</span>
            <button on:click={() => handleClickIncrease()}>→</button>
            <!-- button on:click={sortTable}> → </button> -->
        </div>
    {/if}
</div>

<style>
    .tableContainer {
        display: grid;
        width: 100%;
        height: 100%;
        grid-template-rows: 90% 10%;
        grid-template-columns: 1fr;
        grid-template-areas:
            "table"
            "buttons";
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
        top: 0; /* Don't forget this, required for the stickiness */
        padding: 10px;
        height: 30px;
    }
</style>
