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

	<div class="topBar">
		<Topbar/>
	</div>
	
	<div class="sideBar">
		<Sidebar/>
	</div>

	<div class="main-grid">
		
			<div class="tableContainer">
				{#if length > 0} 
					<Table/>
				{/if}
			</div>
		

		<div class="graphContainer">
			<Graph/>
		</div>

	</div>

</div>

<style>
	.container{
		display: grid;
		width: 100%;
		height: 100%;
		grid-template-columns: 1fr 5fr;
		grid-template-rows: 50px 1fr;
		grid-template-areas:
		"topbar	  topbar  topbar"
		"sidebar  main	  main";
	}

	.topBar {
		grid-area: topbar;
		position: sticky;
		top: 0;
	}

	.sideBar {
		grid-area: sidebar;
		position: sticky;
		top: 0;
	}

	.main-grid {
		overflow-y: hidden;
		display: grid;
		gap: 10px;
		grid-template-columns: 300px 1fr 25px;
		grid-template-rows: 200px 1fr 25px;
		grid-template-areas:
		'widget graph .'
		'widget2 table .'
		'. . .'
	}

	.tableContainer {
		overflow-y: scroll;
		grid-area: table;
        -webkit-box-shadow: 0px 0px 15px -10px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 0px 15px -10px rgba(0, 0, 0, 0.75);
	}

	.graphContainer {
		grid-area: graph;
        -webkit-box-shadow: 0px 0px 15px -10px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 0px 15px -10px rgba(0, 0, 0, 0.75);
	}
</style>
