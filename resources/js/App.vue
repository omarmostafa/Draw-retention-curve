<template>
    <div id="app">
        <highcharts/>
    </div>
</template>

<script>
    import Chart from "./components/ChartComponent";

    export default {
        name: "App",
        components: {
            highcharts: Chart,
        }
    };
</script>

<style>
    #app {
        font-family: "Avenir", Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }
</style>
