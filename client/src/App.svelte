<script>
	import Table from './components/table.svelte'
import UserList from './components/userList.svelte'
	import userList from './components/userList.svelte'

</script>

<div class="main-grid">
	<div id="listContainer">
		<UserList></UserList>
	</div>
	<div id="tableContainer">
		<Table></Table>
	</div>
</div>


<style>

	.main-grid {
		display: grid;
		width: 100%;
		height: 100%;
		grid-template-columns: 150px 1fr;
		grid-template-areas:
		'list table';
	}

	#listContainer {
		overflow-y: scroll;
		grid-area: list;
	}

	#tableContainer {
		overflow-y: scroll;
		grid-area: table;
	}

</style>