<script>
	import axios from 'axios'
	let url = 'http://localhost/jiricom/server'
	const handleSubmit = async e => {
		e.preventDefault()
		fetch(url)
		.then(res => res.json())
		.then(data => {
			console.log('Svar:')
			console.log(data)
		})
		.catch(error => {
			console.log('Error:')
			console.log(error)
		})
	}
</script>

<form action="GET" on:submit={handleSubmit}>
	<label for="user">Get Data form</label><br>
	<input type="submit" value="get data">
</form>

<style>
	form {
		border: 1px solid black;
		width: 50%;
		padding: 1em;
		margin: auto;
	}
</style>