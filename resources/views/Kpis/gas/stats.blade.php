@if(Auth::user()->type=='Gestionnaire parc' ||Auth::user()->type=='Gestionnaire Sup')


<!DOCTYPE html>
<html>
	@include('layouts.head')

@if($month!='')
        <body>

            @include('layouts.header-bar')
            @include('layouts.navbar')


            <div class="mobile-menu-overlay"></div>

                <div class="main-container">
                                    <div class="xs-pd-20-10 pd-ltr-20">
                                        <div class="card-box pd-20 height-100-p mb-30">
                                            <div class="row align-items-center">

                                                <div class="col-md-8">
                                                    <h4 class="font-20 weight-500 mb-10 text-capitalize">



                                                        <div class="weight-600 font-30 text-orange">    Consomation du Carburant en Mois de <b>@switch($month)
                                                            @case(1)  Janvier  @break
                                                                @case(2)  Février  @break
                                                                    @case(3)  Mars   @break
                                                                    @case(4)  Avril @break
                                                            @case(5)  Mai @break
                                                            @case(6)  Juin @break
                                                            @case(7)  Juillet @break
                                                            @case(8)  Aout @break
                                                            @case(9)  Septembre @break
                                                            @case(10)  Octobre @break
                                                            @case(11)  Novembre @break
                                                            @case(12)  Décembre @break
                                                            @default

                                                        @endswitch</b>   </div>
                                                    </h4>

                                                </div>
                                            </div>
                                        </div>
                                    </div>




                <div class="row">


                    <div class="col-md-6 mb-20">
                                    <div class="card-box height-100-p pd-20">

                                        <div id="myChart" class="chart--container">

                                        </div>
                                    </div>




                            </div><div class="col-md-6 mb-20">
                            <div class="card-box height-100-p pd-20" >

                                <div class="rounded-lg shadow-sm mb-12" >
                                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                        <div class="px-3 pt-12 pb-10 text-center relative z-20">
                                            <h1 class="text-sm uppercase text-gray-500 leading-tight text-orange" style="font-size: 2.5em;">Consomation tottale  </h1>
                                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3 text-orange">{{ $TotalGas }} L</h3>

                                        </div>


                                    </div>
                                </div>

                                                <div class="rounded-lg shadow-sm mb-12" >
                                                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                                        <div class="px-3 pt-12 pb-10 text-center relative z-20">
                                                            <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2.5em;">GPL</h1>
                                                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ $GLP }} L</h3>

                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="rounded-lg shadow-sm mb-4">
                                                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                                        <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                                            <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2.5em;">Essence</h1>
                                                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ $Essence }} L</h3>

                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="rounded-lg shadow-sm mb-4">
                                                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                                        <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                                            <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2.5em;">Gazole</h1>
                                                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ $Gazole }} L</h3>

                                                        </div>


                                                    </div>
                                                </div>



                                <!-- BUY ME A BEER AND HELP SUPPORT OPEN-SOURCE RESOURCES -->



                                </div>
                            </div> </div>

                </div>
                    </div> </div>
            <br><br><br>
                <input type="hidden" value="{{ $GLPP}} " id="essenceP">
            <input type="hidden" value="{{ $GazoleP}} " id="gazoleP">
            <input type="hidden" value="{{ $EssenceP}} " id="gplP">

            <script>
                var essenceP = parseInt($("#essenceP").val());
                var gazoleP = parseInt($("#gazoleP").val());
                var gplP = parseInt($("#gplP").val());
                var rest = parseInt($("#gplP").val());

                ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
                let chartConfig = {
                type: 'ring',
                legend: {
                    align: 'center',
                    borderWidth: '0px',
                    item: {
                    cursor: 'pointer',
                    fontSize: '15px',
                    offsetX: '-5px',
                    },
                    layout: 'vertical',
                    marker: {
                    type: 'circle',
                    cursor: 'pointer',
                    size: '10px',
                    },
                    toggleAction: 'remove', // remove plot so it re-calculates percentage
                    verticalAlign: 'middle',
                },
                plot: {
                    tooltip: {
                    visible: false,
                    },
                    detached: false, // turn off click on slices
                    slice: 150, // set hole size in middle of chart
                },
                series: [{text: 'GPL ' ,
                    values: [gplP],
                    backgroundColor: '#FE7A5D',
                    },
                    {text: 'Essence ' ,
                    values: [essenceP],
                    backgroundColor: '#69A8F8',
                    },
                    {
                    text: 'Gazole ' ,
                    values:[gazoleP]  ,
                    backgroundColor: '#54DBB9',
                    },

                ],
                };

                zingchart.render({
                id: 'myChart',
                data: chartConfig,
                height: '100%',
                width: '100%',
                });

                /*
                * Every 35 milliseconds we will update the chart
                * angle by 1.5 degress so it simulates rotatition
                * animation!
                */
                let angle = 0;
                setInterval(function() {
                angle = angle + 1.5;
                zingchart.exec('myChart', 'modify', {
                    object: 'plot',
                    data: {
                    refAngle: angle % 360,
                    },
                });
                }, 35);
            </script>
                <script>
                    const chartOptions = {
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        enabled: false,
                    },
                    elements: {
                        point: {
                            radius: 0
                        },
                    },
                    scales: {
                        xAxes: [{
                            gridLines: false,
                            scaleLabel: false,
                            ticks: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            gridLines: false,
                            scaleLabel: false,
                            ticks: {
                                display: false,
                                suggestedMin: 0,
                                suggestedMax: 10
                            }
                        }]
                    }
                        };
                        //
                        var ctx = document.getElementById('chart1').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: [1, 2, 1, 3, 5, 4, 7],
                                datasets: [
                                    {
                                        backgroundColor: "rgba(101, 116, 205, 0.1)",
                                        borderColor: "rgba(101, 116, 205, 0.8)",
                                        borderWidth: 2,
                                        data: [1, 2, 1, 3, 5, 4, 7],
                                    },
                                ],
                            },
                            options: chartOptions
                        });
                        //
                        var ctx = document.getElementById('chart2').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: [2, 3, 2, 9, 7, 7, 4],
                                datasets: [
                                    {
                                        backgroundColor: "rgba(246, 109, 155, 0.1)",
                                        borderColor: "rgba(246, 109, 155, 0.8)",
                                        borderWidth: 2,
                                        data: [2, 3, 2, 9, 7, 7, 4],
                                    },
                                ],
                            },
                            options: chartOptions
                        });
                        //
                        var ctx = document.getElementById('chart3').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: [2, 5, 1, 3, 2, 6, 7],
                                datasets: [
                                    {
                                        backgroundColor: "rgba(246, 153, 63, 0.1)",
                                        borderColor: "rgba(246, 153, 63, 0.8)",
                                        borderWidth: 2,
                                        data: [2, 5, 1, 3, 2, 6, 7],
                                    },
                                ],
                            },
                            options: chartOptions
                        });
                </script>

            @include('layouts.footer')


        </body>
@endif
@if($monthDA!='')
        <body>

            @include('layouts.header-bar')
            @include('layouts.navbar')


            <div class="mobile-menu-overlay"></div>

                <div class="main-container">
                                    <div class="xs-pd-20-10 pd-ltr-20">
                                        <div class="card-box pd-20 height-100-p mb-30">
                                            <div class="row align-items-center">

                                                <div class="col-md-8">
                                                    <h4 class="font-20 weight-500 mb-10 text-capitalize">



                                                        <div class="weight-600 font-30 text-orange">    Consomation du Carburant en Mois de <b>@switch($monthDA)
                                                            @case(1)  Janvier  @break
                                                                @case(2)  Février  @break
                                                                    @case(3)  Mars   @break
                                                                    @case(4)  Avril @break
                                                            @case(5)  Mai @break
                                                            @case(6)  Juin @break
                                                            @case(7)  Juillet @break
                                                            @case(8)  Aout @break
                                                            @case(9)  Septembre @break
                                                            @case(10)  Octobre @break
                                                            @case(11)  Novembre @break
                                                            @case(12)  Décembre @break
                                                            @default

                                                        @endswitch</b>   </div>
                                                    </h4>

                                                </div>
                                            </div>
                                        </div>
                                    </div>




                <div class="row">


                    <div class="col-md-6 mb-20">
                                    <div class="card-box height-100-p pd-20">

                                        <div id="myChart" class="chart--container">

                                        </div>
                                    </div>




                            </div><div class="col-md-6 mb-20">
                            <div class="card-box height-100-p pd-20" >

                                <div class="rounded-lg shadow-sm mb-12" >
                                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                        <div class="px-3 pt-12 pb-10 text-center relative z-20">
                                            <h1 class="text-sm uppercase text-gray-500 leading-tight text-orange" style="font-size: 2.5em;">Consomation tottale  </h1>
                                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3 text-orange">{{ $TotalDA }} L</h3>

                                        </div>


                                    </div>
                                </div>

                                                <div class="rounded-lg shadow-sm mb-12" >
                                                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                                        <div class="px-3 pt-12 pb-10 text-center relative z-20">
                                                            <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2.5em;">GPL</h1>
                                                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ $GLPDA }} DA</h3>

                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="rounded-lg shadow-sm mb-4">
                                                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                                        <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                                            <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2.5em;">Essence</h1>
                                                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ $EssenceDA }} DA</h3>

                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="rounded-lg shadow-sm mb-4">
                                                    <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                                        <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                                            <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2.5em;">Gazole</h1>
                                                            <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ $GazoleDA }} DA</h3>

                                                        </div>


                                                    </div>
                                                </div>



                                <!-- BUY ME A BEER AND HELP SUPPORT OPEN-SOURCE RESOURCES -->



                                </div>
                            </div> </div>

                </div>







                    </div> </div>


            <br><br><br>
                <input type="hidden" value="{{ $EssenceDA}} " id="essenceP">
            <input type="hidden" value="{{ $GazoleDA}} " id="gazoleP">
            <input type="hidden" value="{{ $GLPDA}} " id="gplP">

            <script>
                var essenceP = parseInt($("#essenceP").val());
                var gazoleP = parseInt($("#gazoleP").val());
                var gplP = parseInt($("#gplP").val());
                var rest = parseInt($("#gplP").val());

                ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
                let chartConfig = {
                type: 'ring',
                legend: {
                    align: 'center',
                    borderWidth: '0px',
                    item: {
                    cursor: 'pointer',
                    fontSize: '15px',
                    offsetX: '-5px',
                    },
                    layout: 'vertical',
                    marker: {
                    type: 'circle',
                    cursor: 'pointer',
                    size: '10px',
                    },
                    toggleAction: 'remove', // remove plot so it re-calculates percentage
                    verticalAlign: 'middle',
                },
                plot: {
                    tooltip: {
                    visible: false,
                    },
                    detached: false, // turn off click on slices
                    slice: 150, // set hole size in middle of chart
                },
                series: [{text: 'GPL ' ,
                    values: [gplP],
                    backgroundColor: '#FE7A5D',
                    },
                    {text: 'Essence ' ,
                    values: [essenceP],
                    backgroundColor: '#69A8F8',
                    },
                    {
                    text: 'Gazole ' ,
                    values:[gazoleP]  ,
                    backgroundColor: '#54DBB9',
                    },

                ],
                };

                zingchart.render({
                id: 'myChart',
                data: chartConfig,
                height: '100%',
                width: '100%',
                });

                /*
                * Every 35 milliseconds we will update the chart
                * angle by 1.5 degress so it simulates rotatition
                * animation!
                */
                let angle = 0;
                setInterval(function() {
                angle = angle + 1.5;
                zingchart.exec('myChart', 'modify', {
                    object: 'plot',
                    data: {
                    refAngle: angle % 360,
                    },
                });
                }, 35);
            </script>
                <script>
                    const chartOptions = {
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        enabled: false,
                    },
                    elements: {
                        point: {
                            radius: 0
                        },
                    },
                    scales: {
                        xAxes: [{
                            gridLines: false,
                            scaleLabel: false,
                            ticks: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            gridLines: false,
                            scaleLabel: false,
                            ticks: {
                                display: false,
                                suggestedMin: 0,
                                suggestedMax: 10
                            }
                        }]
                    }
                        };
                        //
                        var ctx = document.getElementById('chart1').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: [1, 2, 1, 3, 5, 4, 7],
                                datasets: [
                                    {
                                        backgroundColor: "rgba(101, 116, 205, 0.1)",
                                        borderColor: "rgba(101, 116, 205, 0.8)",
                                        borderWidth: 2,
                                        data: [1, 2, 1, 3, 5, 4, 7],
                                    },
                                ],
                            },
                            options: chartOptions
                        });
                        //
                        var ctx = document.getElementById('chart2').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: [2, 3, 2, 9, 7, 7, 4],
                                datasets: [
                                    {
                                        backgroundColor: "rgba(246, 109, 155, 0.1)",
                                        borderColor: "rgba(246, 109, 155, 0.8)",
                                        borderWidth: 2,
                                        data: [2, 3, 2, 9, 7, 7, 4],
                                    },
                                ],
                            },
                            options: chartOptions
                        });
                        //
                        var ctx = document.getElementById('chart3').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: [2, 5, 1, 3, 2, 6, 7],
                                datasets: [
                                    {
                                        backgroundColor: "rgba(246, 153, 63, 0.1)",
                                        borderColor: "rgba(246, 153, 63, 0.8)",
                                        borderWidth: 2,
                                        data: [2, 5, 1, 3, 2, 6, 7],
                                    },
                                ],
                            },
                            options: chartOptions
                        });
                </script>

            @include('layouts.footer')


        </body>
@endif







@if($monthDAm!='')
        <body>

            @include('layouts.header-bar')
            @include('layouts.navbar')




                <div class="main-container">


                                    <div class="xs-pd-20-10 pd-ltr-20">
                                        <div class="card-box pd-20 height-100-p mb-30">
                                            <div class="row align-items-center">

                                                <div class="col-md-8">
                                                    <h4 class="font-20 weight-500 mb-10 text-capitalize">



                                                        <div class="weight-600 font-30 text-orange">    Consomation du Carburant en Mois de: <b>@switch($monthDAm)
                                                            @case(1)  Janvier  @break
                                                                @case(2)  Février  @break
                                                                    @case(3)  Mars   @break
                                                                    @case(4)  Avril @break
                                                            @case(5)  Mai @break
                                                            @case(6)  Juin @break
                                                            @case(7)  Juillet @break
                                                            @case(8)  Aout @break
                                                            @case(9)  Septembre @break
                                                            @case(10)  Octobre @break
                                                            @case(11)  Novembre @break
                                                            @case(12)  Décembre @break
                                                            @default

                                                        @endswitch</b>   </div>
                                                    </h4>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                        <div class="card-box pd-20 height-100-p mb-30">
                                            <div class="row align-items-center">

                                                <div class="col-md-12">




                                                    <div class="rounded-lg shadow-sm mb-4">
                                                        <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                                            <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                                                <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2.5em;">Consomation tottale du Carburant pour les matériels motorisés (DA):</h1>
                                                                <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ $MaterialDA }} DA</h3>

                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        </div>




                                        <div class="card-box pd-20 height-100-p mb-30">
                                            <div class="row align-items-center">

                                                <div class="col-md-12">


                                                    <div class="rounded-lg shadow-sm mb-12" >
                                                        <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                                            <div class="px-3 pt-12 pb-10 text-center relative z-20">
                                                                <h1 class="text-sm uppercase text-gray-500 leading-tight" style="font-size: 2.5em;">Consomation tottale du Carburant pour les matériels motorisés (littre):</h1>
                                                                <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ $MaterialGaz }} L</h3>

                                                            </div>


                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>

                                    </div>




    </div>
            <br><br><br>
                <input type="hidden" value="{{ $GLPP}} " id="essenceP">
            <input type="hidden" value="{{ $GazoleP}} " id="gazoleP">
            <input type="hidden" value="{{ $EssenceP}} " id="gplP">

            <script>
                var essenceP = parseInt($("#essenceP").val());
                var gazoleP = parseInt($("#gazoleP").val());
                var gplP = parseInt($("#gplP").val());
                var rest = parseInt($("#gplP").val());

                ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
                let chartConfig = {
                type: 'ring',
                legend: {
                    align: 'center',
                    borderWidth: '0px',
                    item: {
                    cursor: 'pointer',
                    fontSize: '15px',
                    offsetX: '-5px',
                    },
                    layout: 'vertical',
                    marker: {
                    type: 'circle',
                    cursor: 'pointer',
                    size: '10px',
                    },
                    toggleAction: 'remove', // remove plot so it re-calculates percentage
                    verticalAlign: 'middle',
                },
                plot: {
                    tooltip: {
                    visible: false,
                    },
                    detached: false, // turn off click on slices
                    slice: 150, // set hole size in middle of chart
                },
                series: [{text: 'GPL ' ,
                    values: [gplP],
                    backgroundColor: '#FE7A5D',
                    },
                    {text: 'Essence ' ,
                    values: [essenceP],
                    backgroundColor: '#69A8F8',
                    },
                    {
                    text: 'Gazole ' ,
                    values:[gazoleP]  ,
                    backgroundColor: '#54DBB9',
                    },

                ],
                };

                zingchart.render({
                id: 'myChart',
                data: chartConfig,
                height: '100%',
                width: '100%',
                });

                /*
                * Every 35 milliseconds we will update the chart
                * angle by 1.5 degress so it simulates rotatition
                * animation!
                */
                let angle = 0;
                setInterval(function() {
                angle = angle + 1.5;
                zingchart.exec('myChart', 'modify', {
                    object: 'plot',
                    data: {
                    refAngle: angle % 360,
                    },
                });
                }, 35);
            </script>
                <script>
                    const chartOptions = {
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    tooltips: {
                        enabled: false,
                    },
                    elements: {
                        point: {
                            radius: 0
                        },
                    },
                    scales: {
                        xAxes: [{
                            gridLines: false,
                            scaleLabel: false,
                            ticks: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            gridLines: false,
                            scaleLabel: false,
                            ticks: {
                                display: false,
                                suggestedMin: 0,
                                suggestedMax: 10
                            }
                        }]
                    }
                        };
                        //
                        var ctx = document.getElementById('chart1').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: [1, 2, 1, 3, 5, 4, 7],
                                datasets: [
                                    {
                                        backgroundColor: "rgba(101, 116, 205, 0.1)",
                                        borderColor: "rgba(101, 116, 205, 0.8)",
                                        borderWidth: 2,
                                        data: [1, 2, 1, 3, 5, 4, 7],
                                    },
                                ],
                            },
                            options: chartOptions
                        });
                        //
                        var ctx = document.getElementById('chart2').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: [2, 3, 2, 9, 7, 7, 4],
                                datasets: [
                                    {
                                        backgroundColor: "rgba(246, 109, 155, 0.1)",
                                        borderColor: "rgba(246, 109, 155, 0.8)",
                                        borderWidth: 2,
                                        data: [2, 3, 2, 9, 7, 7, 4],
                                    },
                                ],
                            },
                            options: chartOptions
                        });
                        //
                        var ctx = document.getElementById('chart3').getContext('2d');
                        var chart = new Chart(ctx, {
                            type: "line",
                            data: {
                                labels: [2, 5, 1, 3, 2, 6, 7],
                                datasets: [
                                    {
                                        backgroundColor: "rgba(246, 153, 63, 0.1)",
                                        borderColor: "rgba(246, 153, 63, 0.8)",
                                        borderWidth: 2,
                                        data: [2, 5, 1, 3, 2, 6, 7],
                                    },
                                ],
                            },
                            options: chartOptions
                        });
                </script>
</div>
            @include('layouts.footer')


        </body>
@endif

</html>



@else
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Raleway:500,800" rel="stylesheet">
  <title>Document</title>
</head>
<body>
  <use>
  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" enable-background="new 0 0 1000 1000" xml:space="preserve" class="whistle">
<metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
<g><g transform="translate(0.000000,511.000000) scale(0.100000,-0.100000)">
<path d="M4295.8,3963.2c-113-57.4-122.5-107.2-116.8-622.3l5.7-461.4l63.2-55.5c72.8-65.1,178.1-74.7,250.8-24.9c86.2,61.3,97.6,128.3,97.6,584c0,474.8-11.5,526.5-124.5,580.1C4393.4,4001.5,4372.4,4001.5,4295.8,3963.2z"/><path d="M3053.1,3134.2c-68.9-42.1-111-143.6-93.8-216.4c7.7-26.8,216.4-250.8,476.8-509.3c417.4-417.4,469.1-463.4,526.5-463.4c128.3,0,212.5,88.1,212.5,224c0,67-26.8,97.6-434.6,509.3c-241.2,241.2-459.5,449.9-488.2,465.3C3181.4,3180.1,3124,3178.2,3053.1,3134.2z"/><path d="M2653,1529.7C1644,1445.4,765.1,850,345.8-32.7C62.4-628.2,22.2-1317.4,234.8-1960.8C451.1-2621.3,947-3186.2,1584.6-3500.2c1018.6-501.6,2228.7-296.8,3040.5,515.1c317.8,317.8,561,723.7,670.1,1120.1c101.5,369.5,158.9,455.7,360,553.3c114.9,57.4,170.4,65.1,1487.7,229.8c752.5,93.8,1392,181.9,1420.7,193.4C8628.7-857.9,9900,1250.1,9900,1328.6c0,84.3-67,172.3-147.4,195.3c-51.7,15.3-790.8,19.1-2558,15.3l-2487.2-5.7l-55.5-63.2l-55.5-61.3v-344.6V719.8h-411.7h-411.7v325.5c0,509.3,11.5,499.7-616.5,494C2921,1537.3,2695.1,1533.5,2653,1529.7z"/></g></g>
</svg>
</use>
<h1>403</h1>
<h2>VOUS N'AVEZ PAS ACCÈS À CETTE PAGE!</h2>
</body>
</html>
<style>* {
    margin:0;
    padding: 0;
  }
  body{
    background: #233142;

  }
  .whistle{
    width: 20%;
    fill: #f95959;
    margin: 100px 40%;
    text-align: left;
    transform: translate(-50%, -50%);
    transform: rotate(0);
    transform-origin: 80% 30%;
    animation: wiggle .2s infinite;
  }

  @keyframes wiggle {
    0%{
      transform: rotate(3deg);
    }
    50%{
      transform: rotate(0deg);
    }
    100%{
      transform: rotate(3deg);
    }
  }
  h1{
    margin-top: -100px;
    margin-bottom: 20px;
    color: #facf5a;
    text-align: center;
    font-family: 'Raleway';
    font-size: 90px;
    font-weight: 800;
  }
  h2{
    color: #455d7a;
    text-align: center;
    font-family: 'Raleway';
    font-size: 30px;
    text-transform: uppercase;
  }</style>
                            @endif
