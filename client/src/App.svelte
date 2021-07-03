<script>
	import Search from './components/sidebar/sidebar.svelte'
	import Circle from './components/main/circle.svelte'
	import Widget from './components/main/Widget.svelte'
	import Table from './components/main/table.svelte'
	import Graph from './components/main/bar.svelte'
	
	import { korvStore } from './stores/korvStore'

	let props
	let ready = false
	korvStore.subscribe(data => {
		if(data.length > 0) {
			props = data[0]
			console.log(props)
			ready = true
		}
	})

</script>

	<div class="main-grid">
		
		<div class="tableContainer">
			<Table/>
		</div>
		
		<div class="barContainer">
				<div class="barContainerPrice">
					<Graph/>
				</div>
		
				<div class="barContainerDistance">
					<Graph/>
				</div>
		</div>

		<div class="widgetContainer">
			<div><Search/></div>
			{#if ready}
				<div><Circle/></div>
				<div><Widget imgUrl={'./img/cost.png'} data='{Math.round(props.totalCost)} Kr' plate={props.licensePlate} text='pris'/></div>
				<div><Widget imgUrl={'./img/distance.png'} data='{Math.round(props.totalDistance)} KM' plate={props.licensePlate} text='distance'/></div>
				<div><Widget imgUrl={'./img/cost.png'} data='{props.odometerStop} KM' plate={props.licensePlate} text='Odometer'/></div>
			{/if}
			
		</div>
		
	</div>

<style>
	div {
		background-color: rgb(255, 255, 255);
	}
	.main-grid {
		margin: auto;
		height: 97%;
		width: 98%;
		margin: auto;
		background-color: #F4F6F9;
		display: grid;
		gap: 10px;
		padding: 10px;
		grid-template-rows: 1fr 420px;
		grid-template-columns: 200px 1fr;
		grid-template-areas:
		'widget table'
		'widget bar';
	}

	.main-grid > div {
		border-radius: 5px;
	}
	.barContainer {
		background-color: #F4F6F9;
		grid-area: bar;
		display: flex;	
		gap: 10px;
	}

	.barContainer > * {
		flex: 1;
	}
	.tableContainer {
		grid-area: table;
		overflow-y: hidden;
		display: flex;
		justify-content: center;
		align-items: center;
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
