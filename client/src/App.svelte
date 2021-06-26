<script>
	import Table from "./components/table.svelte";
	import SearchBox from "./components/searchbox.svelte";

	let items = [];
	const handleSearch = (e) => (items = e.detail.data);
	const newPage = (e) => (items = e.detail.data);
</script>

<div class="main-grid">
	<div id="listContainer">
		<SearchBox on:search={handleSearch} />
	</div>
	<div id="tableContainer">
		<Table bind:items on:newPage={newPage} />
	</div>
</div>

<style>
	.main-grid {
		display: grid;
		width: 100%;
		height: 100%;
		margin: auto;
		grid-template-columns: 1fr 400px 1fr;
		grid-template-rows: 50px 1fr;
		grid-template-areas:
			".	search	."
			"table	table	table";
	}

	#listContainer {
		grid-area: search;
	}

	#tableContainer {
		grid-area: table;
	}
</style>
