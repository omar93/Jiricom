<script>
    import { pageStore } from '../../stores/pageStore'
    import { dataStore } from '../../stores/dataStore'
    import propHandler from '../../lib/props'
    import dbHandler from '../../lib/database'

    let db = new dbHandler()
    let prop = new propHandler()
    let textField = ''
    // let startDate = '0000-00-00'
    // let endDate = '9999-99-99'
    // let limit = 17
    let offset = 0
    let plate = 'abc 123'
    

    const handleSubmit = async (e) => {
        prop.newSearch()
        e.preventDefault()
        // kill bar chart
        
        let data = await db.readSearch(`http://localhost/jiricom/server/api/route/readUser.php?licensePlate=${textField}`)
        prop.recordData(data, textField)
        dataStore.set(data)
        plate = textField
    }

    pageStore.subscribe((data) => {
        offset = data
    })
</script>

<form on:submit={handleSubmit}>
    <!-- 
    <div class="dateContainer">
        <span>Från</span><input type="date" bind:value={startDate} />
    </div>

    <div class="dateContainer">
        <span>Till</span><input type="date" bind:value={endDate} />
    </div>
    -->
    <div class="dateContainer">
        <span>Registreringsnummer</span>
        <br>
        <input
            type="text"
            name="licensePlate"
            placeholder="ABC123"
            bind:value={textField}
        />
        
    </div>
    <input type="submit" value="Search" id="button"/>
</form>

<style>
    .dateContainer {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    input {
        width: 85%;
    }

    #button {
        width: 100%;
    }
</style>
