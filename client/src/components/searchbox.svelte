<script>
    import { plateStore } from "../stores/plateStore"
    import { pageStore } from "../stores/pageStore"
    import { createEventDispatcher } from "svelte"
    import dbHandler from "../lib/database"

    let db = new dbHandler()
    let textField = ''
    let startDate
    let endDate
    let offset = 0
    let limit = 17
    const dispatch = createEventDispatcher()

    const handleSubmit = async (e) => {
        e.preventDefault()
        startDate = startDate.split('-').join('')+'000000'
        endDate = endDate.split('-').join('')+'000000'

        let data = await db.readSearch(
            `http://localhost/jiricom/server/api/route/readSearch.php?
            startDate=${startDate}&
            endDate=${endDate}&
            licensePlate=${textField}`
        )
        dispatch("search", data)
        plateStore.set(textField)
    }

    pageStore.subscribe((data) => {
        offset = data
        console.log("Offset is now: ", offset)
    })
</script>

<form on:submit={handleSubmit}>
    <script>
    </script>

    <div id="dateContainer">
        From<input type="date" bind:value={startDate} /><br />
        To<input type="date" bind:value={endDate} />
    </div>

    <style>
    </style>

    <input
        type="text"
        name="licensePlate"
        placeholder="ABC123"
        bind:value={textField}
    />
    <input type="submit" value="Search" />
</form>

<style>
</style>
