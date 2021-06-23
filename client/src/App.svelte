<script>
	import List from './components/table.svelte'

</script>

<div class="main-grid">
	<div id="listContainer">
		<List></List>
	</div>
</div>


<style>

	.main-grid {
		display: grid;
		width: 100%;
		height: 100%;
		grid-template-columns:1fr;
		grid-template-areas:
		'list';
	}

	#listContainer {
		border: 1px solid red;
		overflow-y: scroll;
	}

</style>