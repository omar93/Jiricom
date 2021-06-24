<script>
    import { onMount } from 'svelte'
    import UserItem from './userItem.svelte'

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

    const handleSubmit = e => {
        e.preventDefault()
    }
</script>

<div id="listContainer">
    <form on:submit={handleSubmit}>
        <input type="text">
    </form>

    {#each items as {licensePlate}}
        <UserItem {licensePlate} on:plate></UserItem>
    {/each}
</div>


<style>
    #listContainer {
        width: 100%;
    }

    input {
        width: 100%;
    }
</style>