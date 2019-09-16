<template>

    <div id="app">
        <highcharts :options="options" ref="highcharts"></highcharts>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                options: this.options,
            };
        }
    }
</script>