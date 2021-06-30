<script>
	import Sidebar from './components/sidebar/sidebar.svelte'
	import Distance from './components/main/distance.svelte'
	import Circle from './components/main/circle.svelte'
	import Price from './components/main/Price.svelte'
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

		<div class="widgetContainer">
			<div class="style"><Circle/></div>
			<div class="style"><Price/></div>
			<div class="style"><Distance/></div>
		</div>


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
		'. widget table table .'
		'. widget table table .'
		'. widget graph map .'
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
	.widgetContainer {
		background-color: #F4F6F9;
		grid-area: widget;
		display: flex;
		flex-direction: column;
		gap: 10px;
	}

	.widgetContainer > div {
		min-height: 150px;
	}
</style>
