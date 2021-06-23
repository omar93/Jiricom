<script>
	let url = 'http://localhost/jiricom/server/api/route/read.php'
	let dataArr = []
	const handleSubmit = async e => {
		e.preventDefault()
		try {
			let req = await fetch(url)
			let data = await req.json()
			console.log('Data:')
			// console.log(data)
			dataArr = data.data
			runList(dataArr)
		} catch(err) {
			console.log('Error:')
			console.log(err)
		}
	}

	const runList = (data) => {
		data.forEach(user => {
			console.log(user)
		});
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