<script>
	import Sidebar from './components/sidebar/sidebar.svelte'
	import Circle from './components/main/circle.svelte'
	import Table from './components/main/table.svelte'
	import Graph from './components/main/bar.svelte'
	import Map from './components/main/map.svelte'
</script>

<div class="container">

	<div class="sideBarContainer">
		<Sidebar/>
	</div>

	<div class="main-grid">
		
		<div class="tableContainer style">
			<Table/>
		</div>
		

		<div class="graphContainer style">
			<Graph/>
		</div>

		<div class="widget1 style"><Circle/></div>
		<div class="widget2 style">2</div>
		<div class="widget3 style"></div>

		<div class="mapContainer">
			<Map/>
		</div>
		
	</div>

</div>

<style>
	div {
		background-color: rgb(255, 255, 255);
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
		grid-template-columns: 10px 250px 1fr 800px 10px;
		grid-template-rows: 10px 300px 100px 1fr 10px;
		grid-template-areas:
		'. . . . .'
		'. widget1 table table .'
		'. widget2 table table .'
		'. widget3 graph map .'
		'. . . . .';
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
	.mapContainer {
		grid-area:map;
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
