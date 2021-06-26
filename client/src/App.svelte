<script>
	import Sidebar from './components/sidebar/sidebar.svelte'
	import Topbar from './components/topbar/topbar.svelte'
	import Graph from './components/main/graph.svelte'
	import Table from './components/main/table.svelte'
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
			<Table/>
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
		border: 1px solid red;
		position: sticky;
		top: 0;
	}

	.sideBar {
		grid-area: sidebar;
		border: 1px solid red;
		position: sticky;
		top: 0;
	}

	.main-grid {
		overflow-y: hidden;
		display: grid;
		width: 100%;
		height: 100%;
		grid-template-columns: repeat(4,1fr);
		grid-template-rows: 150px 1fr;
		grid-template-areas:
		'top top top top'
		'table table graph graph'
	}

	/* width */
	::-webkit-scrollbar {
	width: 10px;
	}

	/* Track */
	::-webkit-scrollbar-track {
	background: #f1f1f1; 
	}
	
	/* Handle */
	::-webkit-scrollbar-thumb {
	background: #888; 
	}

	/* Handle on hover */
	::-webkit-scrollbar-thumb:hover {
	background: #555; 
	}

	.tableContainer {
		overflow-y: scroll;
		grid-area: table;
	}
</style>
