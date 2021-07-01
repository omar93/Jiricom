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
		
		<div class="top-main">

			<div class="widgetContainer">
				<div><Circle/></div>
				<div><Price/></div>
				<div><Distance/></div>
			</div>

			<div class="tableContainer style">
				<Table/>
			</div>
	

		</div>

		
		<div class="barContainer">

			<div class="barContainerPrice style">
				<Graph/>
			</div>
			<div class="barContainerDistance style">
				<Graph/>
			</div>

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
	.main-grid {
		flex: 1;
		background-color: #F4F6F9;
		overflow-y: scroll;
		display: flex;
		flex-direction: column;
		gap: 10px;
	}

	.top-main {
		background-color: #F4F6F9;
		display: flex;
		gap: 10px;
		padding: 10px;
	}

	.main-grid > div {
		border-radius: 5px;
	}
	.barContainer {
		background-color: #F4F6F9;
		grid-area: bar;
		display: flex;
		gap: 10px;
		padding:10px;
		padding-top:0px
	}

	.barContainer > * {
		flex: 1;
	}
	.tableContainer {
		flex: 1;
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
		justify-content: space-between;
	}

	.widgetContainer > div {
		flex: 1;
	}
</style>
