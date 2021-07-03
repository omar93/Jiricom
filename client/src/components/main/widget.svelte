<script>
    export let imgUrl,data,plate,text
</script>

<div class="widgetContainer">
    <img src={imgUrl} alt="cost arrow">
    <span>Totalt {text} för</span>
    <span>{plate}</span>
    <span>{data}</span>
</div>

<style>
    .widgetContainer {
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