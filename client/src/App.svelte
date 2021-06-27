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
		
			<div class="tableContainer style">
				{#if length > 0}
				<div class="wrapper"><Table/></div>
					
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
	.container{
		display: grid;
		width: 100%;
		height: 100%;
		grid-template-columns: 1fr 5fr;
		grid-template-rows: 70px 1fr;
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
		grid-template-columns: 300px 1fr;
		grid-template-rows: 1fr 1fr 200px 10px;
		grid-template-areas:
		'widget1 table'
		'widget2 table'
		'widget3 graph'
		'.	.';
	}
	.graphContainer {
		grid-area: graph;
	}
	.tableContainer {
		grid-area: table;
		overflow-y: scroll;
		border: 1px solid black;
		padding: 0;
		margin: 0;
	}

	.widget1 {
		grid-area: widget1;
	}

	.style {
		-webkit-box-shadow: -4px -4px 20px -15px #000000; 
		box-shadow: -4px -4px 20px -15px #000000;
		border: 1px solid rgba(0, 0, 0, 0.438);
	}
</style>
