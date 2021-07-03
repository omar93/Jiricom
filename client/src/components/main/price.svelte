<script>
    import { plateStore } from '../../stores/plateStore'
    import { widgetStore } from '../../stores/widgetStore'

    let price
    let plate = 'abc123'

    widgetStore.subscribe(data => {
        price = 0
        data.forEach(object => {
            price += Math.round(parseFloat(object.cost))
        })
    })

    plateStore.subscribe(data => plate = data)

</script>

<div class="priceContainer">
        <img src="./img/cost.png" alt="cost arrow">
        <span>Total kostnad för {plate}</span>
        <span class="price">{price} Kr</span>
</div>

<style>
    .priceContainer {
        position: relative;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    img{
        width: 50px;
    }
</style>