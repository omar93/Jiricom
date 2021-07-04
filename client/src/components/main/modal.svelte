<script>
    import  { fullDataStore } from '../../stores/fullDataStore'
    import { createEventDispatcher } from 'svelte'
    let allData = []

    const dispatch = createEventDispatcher()
    fullDataStore.subscribe(data => allData = data)

    const handleClose = () => {
        dispatch('close')
    }
</script>
<div class="modelContainer" on:click|self={handleClose}>
    <div class="signinContainer">
        <div class="keys">
            {#each Object.keys(allData) as data}
                <p>{data}</p>
            {/each}
        </div>
        <div class="values">
            {#each Object.values(allData) as data}
                <p>{data}</p>
            {/each}
        </div>
    </div>
</div>
<style>
    .modelContainer {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.2);
    }
    .signinContainer {
        width: 70%;
        height: 70%;
        margin: auto;
        margin-top: 5%;
        border-radius: 1em;
        padding: 1em;
        background-color: white;
        display: flex;
        justify-content: space-around;
    }
</style>