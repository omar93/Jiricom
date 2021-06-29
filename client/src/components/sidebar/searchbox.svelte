<script>
    import { plateStore } from "../../stores/plateStore"
    import { priceStore } from '../../stores/priceStore'
    import { pageStore } from "../../stores/pageStore"
    import { dataStore } from "../../stores/dataStore"
    import dbHandler from "../../lib/database"

    let db = new dbHandler()
    let textField = ''
    let startDate = '0000-00-00'
    let endDate = '9999-99-99'
    let offset = 0
    let limit = 17
    let plate = 'abc 123'
    

    const handleSubmit = async (e) => {
        dataStore.set({'data':[]})
        priceStore.set([])
        console.log('after reset: ', $priceStore)
        plateStore.set('')
        e.preventDefault()
        let data = await db.readSearch(`http://localhost/jiricom/server/api/route/readUser.php?licensePlate=${textField}`)
        dataStore.set(data)
        plate = textField

    }

    pageStore.subscribe((data) => {
        offset = data
        console.log("Offset is now: ", offset)
    })
</script>

<form on:submit={handleSubmit}>
    <div class="dateContainer">
        <span>Från</span><input type="date" bind:value={startDate} />
    </div>

    <div class="dateContainer">
        <span>Till</span><input type="date" bind:value={endDate} />
    </div>
    
    <div class="dateContainer">
        <span>Reg</span>
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
        align-items: center;
        justify-content: space-between;
    }

    span {
        width: 15px;
    }

    input {
        width: 85%;
    }

    #button {
        width: 100%;
    }
</style>
