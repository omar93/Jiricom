<script>
    import { plateStore } from "../stores/plateStore";
    import { pageStore } from "../stores/pageStore";
    import { createEventDispatcher } from "svelte";
    import dbHandler from "../lib/database";

    let db = new dbHandler();
    let textField = "";
    let offset = 0;
    let limit = 17;
    const dispatch = createEventDispatcher();

    const handleSubmit = async (e) => {
        e.preventDefault();
        let data = await db.getSingleItem(
            `http://localhost/jiricom/server/api/route/readSingle.php?licensePlate=${textField}&offset=${offset}&limit=${limit}`
        );
        dispatch("search", data);
        plateStore.set(textField);
    };

    pageStore.subscribe((data) => {
        offset = data;
        console.log("Offset is now: ", offset);
    });
</script>

<form on:submit={handleSubmit}>
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
