<script>
	import Sidebar from './components/sidebar/sidebar.svelte'
	import Topbar from './components/topbar/topbar.svelte'
	import Graph from './components/main/graph.svelte'
	import Table from './components/main/table.svelte'
	import {dataStore} from './stores/dataStore'

	let length = 0
	dataStore.subscribe(data => length = data.data.length)
</script>

<div class="container">

	<div class="sideBarContainer">
		<Sidebar/>
	</div>

	<div class="main-grid">
		
		<div class="tableContainer style">
			{#if length > 0}
				<Table/>
			{/if}
		</div>
		

		<div class="graphContainer style">
			<Graph/>
		</div>

		<div class="widget1 style">widget 1</div>
		<div class="widget2 style">widget 2</div>
		<div class="widget3 style">widget 3</div>
		
	</div>

</div>

<style>
	div {
		background-color: white;
	}
	.container{
		display: flex;
		width: 100%;
		height: 100%;
		
	}

	.sideBarContainer {
		flex: 1;
	}
	.main-grid {
		flex: 8;
		background-color: #F4F6F9;
		overflow-y: scroll;
		display: grid;
		row-gap: 10px;
		column-gap: 10px;
		grid-template-columns: 10px 300px 1fr 10px;
		grid-template-rows: 10px 1fr 1fr 1fr 10px;
		grid-template-areas:
		'. . . .'
		'. widget1 table .'
		'. widget2 table .'
		'. widget3 graph .'
		'. . . .';
	}

	.main-grid > div {
		border-radius: 5px;
	}
	.graphContainer {
		grid-area: graph;
	}
	.tableContainer {
		grid-area: table;
		overflow-y: hidden;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.widget1 {
		grid-area: widget1;
	}
	.widget2 {
		grid-area: widget2;
	}
	.widget3 {
		grid-area: widget3;
	}
</style>
