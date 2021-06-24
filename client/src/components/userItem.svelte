<script>
    import { onMount } from 'svelte'
    export let licensePlate = 'abc123'
    let items = []
    let url = 'http://localhost/jiricom/server/api/route/readPlates.php'

    onMount(async () => {
        try {
            let req = await fetch(url)
            let data = await req.json()
            items = data.data
        } catch(err) {
            console.log(err)
        }
    }) 
</script>

<div class="itemContainer">
    <p>{licensePlate}</p>
</div>


<style>
    .itemContainer {
        border: 1px solid black;
    }
</style>