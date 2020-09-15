@extends('blank')

@section('css')
    <link href="{{ URL::asset('assets/plugins/nvd3/nv.d3.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ URL::asset('assets/plugins/rickshaw/rickshaw.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .widget-toppresentation:after {
            background-image: url("/{{$toppresentation->ThumURI}}");
        }

        .charthome {
            height: 572px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid padding-25 sm-padding-10">
        <div class="row">
            <div class="col-md-6 col-xlg-5">
                <div class="panel">
                    <div id="chartview" class="line-chart m-t-30 text-center charthome" data-x-grid="false">
                        <svg></svg>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xlg-5">
                <div class="row">
                    <div class="col-sm-6 m-b-10">
                        <div class="ar-1-1">
                            <div class="widget-7 panel no-border bg-success no-margin">
                                <div class="panel-heading">
                                    <h2 class="no-margin text-white p-b-10 text-center">
                                        Nombre de <span class="semi-bold">vue</span> total
                                    </h2>
                                </div>
                                <div class="panel-body">
                                    <div class="pull-bottom padding-50">
                                        <h1 class="text-white semi-bold text-center" style="font-size: 152px;">
                                            {{$totalviews[0]->total}}
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 m-b-10">
                        <div class="ar-1-1">
                            <div class="widget-7 panel no-border bg-danger no-margin">
                                <div class="panel-heading">
                                    <h2 class="no-margin text-white p-b-10 text-center">
                                        Nombre de <span class="semi-bold ">vue</span> de cette semaine
                                    </h2>
                                </div>
                                <div class="panel-body">
                                    <div class="pull-bottom padding-50">
                                        <h1 class="text-white semi-bold text-center" style="font-size: 152px;">
                                            {{$totalviewsweek[0]->total}}
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 m-b-10">
                        <div class="ar-1-1">
                            <div class="widget widget-toppresentation panel no-border bg-info no-margin">
                                <div class="panel-heading">
                                    <h2 class="no-margin text-white p-b-10 text-center">
                                        <span class="semi-bold">Top</span> presentation
                                    </h2>
                                </div>
                                <div class="panel-body">
                                    <div class="pull-bottom padding-50">
                                        <h1 class="text-white semi-bold text-center"">
                                        {{$toppresentation->nom}}
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        @endsection


        @section('js')

            <script src="{{ URL::asset('assets/plugins/nvd3/lib/d3.v3.js')}}" type="text/javascript"></script>
            <script src="{{ URL::asset('assets/plugins/nvd3/nv.d3.min.js')}}" type="text/javascript"></script>
            <script src="{{ URL::asset('assets/plugins/nvd3/src/utils.js')}}" type="text/javascript"></script>
            <script src="{{ URL::asset('assets/plugins/nvd3/src/tooltip.js')}}" type="text/javascript"></script>
            <script src="{{ URL::asset('assets/plugins/nvd3/src/interactiveLayer.js')}}" type="text/javascript"></script>
            <script src="{{ URL::asset('assets/plugins/nvd3/src/models/axis.js')}}" type="text/javascript"></script>
            <script src="{{ URL::asset('assets/plugins/nvd3/src/models/line.js')}}" type="text/javascript"></script>
            <script src="{{ URL::asset('assets/plugins/nvd3/src/models/lineWithFocusChart.js')}}" type="text/javascript"></script>
            <script src="{{ URL::asset('assets/plugins/rickshaw/rickshaw.min.js')}}"></script>

            <script>
                (function () {
                    data = [

                        {
                            "key": "Nombre de vue de chaque presentation",
                            "values": [
                                @foreach($previw as $p)
                                ["{{$p['nom']}}", {{$p['views']}}],
                                @endforeach
                        ]
                        },

                    ];
                    nv.addGraph(function () {
                        var chart = nv.models.multiBarChart()
                                .x(function (d,i) {
                                    return d;
                                })
                                .y(function (d) {
                                    return parseInt(d[1])
                                });
                        chart.xAxis.tickFormat(function(d){
                            return d;
                        });
                        chart.tooltip(function(key, x, y, e, graph) {
                            return '<p><b>' + x[0] + '</b> : ' + x[1] + '</p>';
                        });
                        chart.color(["rgba(245, 87, 83, 1)"]);
                        d3.select('#chartview svg').datum(data).transition().duration(500).call(chart);
                        nv.utils.windowResize(chart.update);
                        $('#chartview').data('chart', chart);
                        return chart;
                    });
                })();
            </script>
@endsection