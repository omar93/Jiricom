<script>
	import Table from './components/table.svelte'
	import SearchBox from './components/searchbox.svelte'

	let items = []
	const handleSearch = e => items = e.detail.data

</script>

<div class="main-grid">
	<div id="listContainer">
		<SearchBox on:search={handleSearch}></SearchBox>
	</div>
	<div id="tableContainer">
		<Table bind:items></Table>
	</div>
</div>


<style>
	.main-grid {
		display: grid;
		width: 100%;
		height: 100%;
		grid-template-columns: 1fr 400px 1fr;
		grid-template-rows: 80px 1fr;
		grid-template-areas:
		'.	search	.'
		'table	table	table';
	}

	#listContainer {
		grid-area: search;
		
	}

	#tableContainer {
		grid-area: table;
		overflow-y: scroll;
	}

</style>