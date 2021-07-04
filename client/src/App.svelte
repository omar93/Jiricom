<script>
	import Search from './components/sidebar/sidebar.svelte'
	import Circle from './components/main/circle.svelte'
	import Widget from './components/main/Widget.svelte'
	import Table from './components/main/table.svelte'
	import Graph from './components/main/bar.svelte'
	
	import { korvStore } from './stores/korvStore'
	import { fade, fly } from 'svelte/transition';

	let props
	let ready = false
	let costMonth,costCost,distanceMonth,distanceDistance
	korvStore.subscribe(data => {
		if(data.length > 0) {
			props = data[0]	
			costMonth = data[0].costMonth.map(item => item.month)
			costCost = data[0].costMonth.map(item => item.cost)
			distanceMonth = data[0].distanceMonth.map(item => item.month)
			distanceDistance = data[0].distanceMonth.map(item => item.distance)
			ready = true
		}
	})

</script>

	<div class="main-grid">
		{#if ready}
		<div class="tableContainer" transition:fly="{{ x: 500, duration: 1000 }}">
			<Table/>
		</div>
		
		<div class="barContainer">
			
				<div class="barContainerDistance" transition:fly="{{ y: 500, duration: 1000 }}">
					<Graph month={costMonth} data={costCost} text='Sträcka'/>
				</div>

				<div class="barContainerPrice" transition:fly="{{ y: 500, duration: 1000 }}">
					<Graph month={distanceMonth} data={distanceDistance} text='Bensin'/>
				</div>
			
		</div>
		{/if}
		<div class="widgetContainer">
			<div><Search/></div>
			{#if ready}
				<div transition:fade={{delay:1000}}><Circle/></div>
				<div transition:fade={{delay:750}}><Widget imgUrl={'./img/cost.png'} data='{Math.round(props.totalCost)} Kr' plate={props.licensePlate} text='pris'/></div>
				<div transition:fade={{delay:500}}><Widget imgUrl={'./img/distance.png'} data='{Math.round(props.totalDistance)} KM' plate={props.licensePlate} text='sträcka'/></div>
				<div transition:fade={{delay:250}}><Widget imgUrl={'./img/cost.png'} data='{props.odometerStop} KM' plate={props.licensePlate} text='odometer'/></div>
				<div transition:fade={{delay:250}}><Widget imgUrl={'./img/time.png'} data='{props.travelTime} H' plate={props.licensePlate} text='tid'/></div>
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
