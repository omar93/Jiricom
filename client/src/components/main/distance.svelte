<script>    
        import { widgetStore } from '../../stores/widgetStore'
        import { plateStore } from '../../stores/plateStore'
    
        let distance
        let plate = 'abc123'
    
        widgetStore.subscribe(data => {
            distance = 0
            data.forEach(object => {
                console.log('object: ', object)
                distance += Math.round(parseFloat(object.distance))
            })
        })
    
        plateStore.subscribe(data => plate = data)
    
    </script>
    
    <div class="priceContainer">
            <img src="./img/distance.png" alt="distance">
            <span>Total sträcka för {plate}</span>
            <span class="price">{distance} KM</span>
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
            width: 150px;
            left: -55px;
        }
    </style>