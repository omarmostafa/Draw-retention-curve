<template>
    <div>
        <div class="lds-ring" v-if="loading">
            Loading...
        </div>
        <div v-if="chartData">
            <highcharts
                    :options="chartOptions"
                    ref="lineCharts"
                    :constructor-type="stockChart"
            ></highcharts>
        </div>
    </div>
</template>

<script>
    import {Chart} from "highcharts-vue";

    export default {
        props: {
            partsdata: {
                type: Array
            }
        },

        components: {
            highcharts: Chart
        },

        created() {
            this.fetchData();
        },

        methods: {
            fetchData() {
                this.axios
                    .get('/api/v1/charts')
                    .then(response => {
                        this.loading = false;
                        this.chartData = response.data.data;
                        this.chartOptions.series = this.chartData.users_percentage;
                        this.chartOptions.xAxis.categories = this.chartData.boarding_flow_percentage;
                    });
            }
        },


        data() {
            return {
                chartData: null,
                loading: true,
                chartOptions: {
                    chart: {
                        type: "spline",
                        title: "Onboarding flow"
                    },
                    title: {
                        text: 'Up case retention curve'
                    },

                    subtitle: {
                        text: 'On boarding flow'
                    },
                    xAxis: {
                        categories: []
                    },
                    tooltip: {
                        crosshairs: true,
                        shared: true
                    },
                    credits: {
                        enabled: false
                    },
                    plotOptions: {
                        spline: {
                            marker: {
                                radius: 4,
                                lineColor: "#666666",
                                lineWidth: 1
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
                    series: []
                }
            };
        }
    };
</script>