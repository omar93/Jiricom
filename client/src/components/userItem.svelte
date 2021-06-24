<script>
    import { onMount,createEventDispatcher } from 'svelte'

    export let licensePlate = 'abc123'

    let items = []
    let url = 'http://localhost/jiricom/server/api/route/readPlates.php'
    const dispatch = createEventDispatcher()

    onMount(async () => {
        try {
            let req = await fetch(url)
            let data = await req.json()
            items = data.data
        } catch(err) {
            console.log(err)
        }
    })

    const handlePlateClick = e => {
        let plate = e.path[0].textContent
        dispatch('plate', plate)
    }
</script>

<div class="itemContainer" on:click={handlePlateClick}>
    <p>{licensePlate}</p>
</div>


<style>
    .itemContainer {
        border: 1px solid black;
    }
</style>