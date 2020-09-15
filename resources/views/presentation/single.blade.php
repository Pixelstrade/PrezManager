@extends('blank')

@section('css')
    <link href="{{ URL::asset('assets/plugins/nvd3/nv.d3.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ URL::asset('assets/plugins/rickshaw/rickshaw.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        #question {
            min-height: 500px;
        }
    </style>
@endsection

@section('content')


    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 pull-right">
            <div class="btn-group btn-group-justified ">
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#uploadModal">
                        <span class="p-t-5 p-b-5">
                        <i class="fa fa-cloud-upload fs-15"></i>
                        </span>
                        <br>
                        <span class="fs-11 font-montserrat text-uppercase">Mettre à jour</span>
                    </button>
                </div>

                <div class="btn-group">
                    <a type="button" class="btn btn-default"
                       href="{{ url('presentation', array($presentation, 'download')) }}">
                        <span class="p-t-5 p-b-5">
                        <i class="fa fa-cloud-download fs-15"></i>
                        </span>
                        <br>
                        <span class="fs-11 font-montserrat text-uppercase">Télécharger</span>
                    </a>
                </div>


                <div class="btn-group">
                    <a type="button" class="btn btn-default btn-danger"
                       href="{{ url('presentation', array($presentation, 'edit')) }}">
                        <span class="p-t-5 p-b-5">
                        <i class="fa fa-pencil fs-15"></i>
                        </span>
                        <br>
                        <span class="fs-11 font-montserrat text-uppercase">Modifier</span>
                    </a>
                </div>

                <div class="btn-group">
                    <a type="button" class="btn btn-default btn-danger"
                       href="{{ url('presentation', array($presentation, 'delete')) }}">
                        <span class="p-t-5 p-b-5">
                        <i class="fa  fa-trash fs-15"></i>
                        </span>
                        <br>
                        <span class="fs-11 font-montserrat text-uppercase">Supprimer</span>
                    </a>
                </div>





                {{--<div class="btn-group">--}}
                {{--<button type="button" class="btn btn-default">--}}
                {{--<span class="p-t-5 p-b-5">--}}
                {{--<i class="pg-form fs-15"></i>--}}
                {{--</span>--}}
                {{--<br>--}}
                {{--<span class="fs-11 font-montserrat text-uppercase">Editer</span>--}}
                {{--</button>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
    <br/>

    <div class="panel">
        <ul class="nav nav-tabs nav-tabs-simple" role="tablist">
            <li class="active"><a href="#statistique" data-toggle="tab" role="tab">Statistiques</a>
            </li>
            <li><a href="#question" data-toggle="tab" role="tab">Question</a>
            </li>
            <li><a href="#information" data-toggle="tab" role="tab">Information</a>
            </li>
            <li><a href="#personnels" data-toggle="tab" role="tab">Personnels</a>
            </li>
            <li><a href="#groupes" data-toggle="tab" role="tab">Groupes</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="statistique">
                <div class="row column-seperation">

                    <div class="row">
                        <div class="col-md-6">
                            <div id="chartview" class="line-chart m-t-30 text-center" data-x-grid="false">
                                <svg></svg>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="durationpie" class="m-t-30 text-center">
                                <svg></svg>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="tab-pane" id="question">


                @foreach(array_chunk($questions, 2) as $k => $twoQuestions)
                    <div class="row">
                     @foreach($twoQuestions as $key => $q)


                            <div class="col-md-6">
                                <h3 class="text-center">{{$q->Question}}</h3>

                                <div id="question{{$key + $k*2}}" class="m-t-30 text-center questionpie">
                                    <svg></svg>
                                </div>
                            </div>



                    @endforeach
                    </div>
                @endforeach
            </div>
            <div class="tab-pane " id="information">

                <div class="row">

                    <div class="col-md-8">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6"><h2>Nom :</h2></div>
                                    <div class="col-md-6"><h2>{{ $presentation->nom}}</h2></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6"><h2>Description :</h2></div>
                                    <div class="col-md-6"><h2>{{ $presentation->description}}</h2></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6"><h2>Version :</h2></div>
                                    <div class="col-md-6"><h2>{{ $presentation->version}}</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <img src="{{ URL::asset($presentation->ThumURI)}}" alt=""/>

                    </div>
                </div>

            </div>
            <div class="tab-pane" id="personnels">
                <div class="row">
                    <div class="col-md-12">


                        <div class="panel">
                            <div class="panel-heading">

                                <div class="row">
                                    <div class="col-md-4 col-xs-12 pull-right">
                                        <input type="text" id="search-table" class="form-control"
                                               placeholder="Chercher">
                                    </div>
                                    <div class="col-md-4 col-xs-12 pull-right">
                                        <a id="show-modal" href="#" data-toggle="modal" data-target="#linkModal"
                                           class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i>
                                            Ajouter</a>
                                    </div>

                                </div>


                                <div class="clearfix">
                                </div>


                            </div>
                            <div class="panel-body">
                                <table id="tableWithSearch" class="table table-hover demo-table-search" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($presentation->users as $key => $value)
                                        <tr>
                                            <td>{{ $value->nom }}</td>
                                            <td>{{ $value->prenom }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>
                                                <a href="{{ url('presentation', array($presentation, 'unlinkUser',$value->id)) }}">
                                                    <i class="fa fa-chain-broken"></i> Détacher
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane" id="groupes">


                <div class="row">
                    <div class="col-md-12">


                        <div class="panel">
                            <div class="panel-heading">

                                <div class="row">
                                    <div class="col-md-4 col-xs-12 pull-right">
                                        <input type="text" id="search-table2" class="form-control"
                                               placeholder="Chercher">
                                    </div>
                                    <div class="col-md-4 col-xs-12 pull-right">
                                        <a id="show-modal" href="#" data-toggle="modal" data-target="#linkgroupeModal"
                                           class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i>
                                            Ajouter</a>
                                    </div>

                                </div>


                                <div class="clearfix">
                                </div>


                            </div>
                            <div class="panel-body">
                                <table id="tableWithSearch2" class="table table-hover demo-table-search" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($presentation->groupes as $key => $value)
                                        <tr>
                                            <td>{{ $value->nom }}</td>
                                            <td>
                                                <a href="{{ url('presentation', array($presentation, 'unlinkGroupe',$value->id)) }}">
                                                    <i class="fa fa-chain-broken"></i> Détacher
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>



    <!-- Modal Upload-->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="pg-close fs-14"></i>
                        </button>
                        <h5>Mise à jour du Presentation</h5>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="updateForm" action="post" accept-charset="UTF-8"
                              enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group-attached">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label>Selectionner Fichier</label>
                                            <input type="file" name="zipfile" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="p-t-30 clearfix p-l-10 p-r-10">
                                    <div class="progress">
                                        <div class="progress-bar" id="progressUpdate" data-percentage="0%"
                                             style="width: 0%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 m-t-10 sm-m-t-10">
                                <button id="updatebt" type="button" class="btn btn-primary btn-block m-t-5">Upload
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <!-- Modal Link-->
    <div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="pg-close fs-14"></i>
                        </button>
                        <h5>Mise à jour du Presentation</h5>
                    </div>
                    <form role="form" method="post" action="{{ url('presentation', array($presentation, 'linkUser')) }}"
                          accept-charset="UTF-8">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group-attached">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default form-group-default-select2">
                                            <label>Selectionner Personnel</label>
                                            <select id="multi" name="users[]" class="full-width" multiple>
                                                @foreach($users as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->nom }} {{ $value->prenom}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                    <input type="submit" class="btn btn-primary btn-block m-t-5" value="Associer"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>





    <!-- Modal Link-->
    <div class="modal fade" id="linkgroupeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                                    class="pg-close fs-14"></i>
                        </button>
                        <h5>Mise à jour du Presentation</h5>
                    </div>
                    <form role="form" method="post"
                          action="{{ url('presentation', array($presentation, 'linkGroupe')) }}" accept-charset="UTF-8">
                        <div class="modal-body">

                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="form-group-attached">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default form-group-default-select2">
                                            <label>Selectionner Groupe</label>
                                            <select id="multi2" name="groupes[]" class="full-width" multiple>
                                                @foreach($groupes as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4 m-t-10 sm-m-t-10 pull-right">
                                    <input type="submit" class="btn btn-primary btn-block m-t-5" value="Associer"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')


    <script src="{{ URL::asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/datatables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/lodash.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/datatables.js')}}" type="text/javascript"></script>

    <script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-select2/select2.min.js')}}"></script>

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


        var table = $('#tableWithSearch2');
        var settings = {
            "sDom": "<'table-responsive't><'row'<p i>>",
            "sPaginationType": "bootstrap",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {"sLengthMenu": "_MENU_ ", "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"},
            "iDisplayLength": 5
        };
        table.dataTable(settings);
        $('#search-table2').keyup(function () {
            table.fnFilter($(this).val());
        });


        $('#updatebt').click(function () {
            var formData = new FormData($('#updateForm')[0]);
            $.ajax({
                url: window.location + '/updateZip',  //Server script to process data
                type: 'POST',
                xhr: function () {  // Custom XMLHttpRequest
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) { // Check if upload property exists
                        myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // For handling the progress of the upload
                    }
                    return myXhr;
                },
                //Ajax events
                beforeSend: beforeSendHandler,
                success: completeHandler,
                error: errorHandler,
                // Form data
                data: formData,
                //Options to tell jQuery not to process data or worry about content-type.
                cache: false,
                contentType: false,
                processData: false
            });
        });

        function beforeSendHandler(e) {
            $('#progressUpdate').css('width', '0%');
            $('#progressUpdate').data('percentage', '0%');
        }
        function progressHandlingFunction(e) {
            if (e.lengthComputable) {
                var percentage = (e.loaded / e.total) * 100
                $('#progressUpdate').css('width', percentage + '%');
                $('#progressUpdate').data('percentage', percentage + '%');

            }
        }
        function completeHandler(e) {
            $('#progressUpdate').css('width', '100%');
            $('#progressUpdate').data('percentage', '100%');
            console.log(e);
            if (e['upload'] != undefined && e['upload'] == 'success') {
                window.location.reload();
            }
        }
        function errorHandler(e) {
            alert("Erreur lors de mise à jour");
            window.location.reload();
        }


        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            jQuery(window).trigger('resize');
            console.log("resize");
        });

        $("#multi").select2();
        $("#multi2").select2();
    </script>


    <script>

        (function () {
            data = [{
                "key": "Nombre de vue",
                "values": [
                    @foreach($views as $v)
                    ["{{$v->created_at}}", "{{$v->total}}"],
                    @endforeach
                ]
            }];
            nv.addGraph(function () {
                var chart = nv.models.lineChart().x(function (d) {
                    return new Date(d[0])
                }).y(function (d) {
                    return parseInt(d[1])
                }).color([$.Pages.getColor('success'), $.Pages.getColor('danger'), $.Pages.getColor('primary'), $.Pages.getColor('complete'),]).useInteractiveGuideline(true);
                chart.xAxis.tickFormat(function (d) {
                    return d3.time.format('%x')(new Date(d))
                });
                chart.yAxis.tickFormat(d3.format(',.2f'));
                d3.select('#chartview svg').datum(data).transition().duration(500).call(chart);
                nv.utils.windowResize(chart.update);
                $('#chartview').data('chart', chart);
                return chart;
            });
        })();


        (function () {
            nv.addGraph(function () {
                var chart = nv.models.pieChart()
                        .x(function (d) {
                            return d.label
                        })
                        .y(function (d) {
                            return d.value
                        })
                    //.color([$.Pages.getColor('success'), $.Pages.getColor('danger'), $.Pages.getColor('primary'), $.Pages.getColor('complete'), ])
                        .showLabels(true);

                d3.select("#durationpie svg")
                        .datum(calculData())
                        .transition().duration(350)
                        .call(chart);

                nv.utils.windowResize(chart.update);

                return chart;
            });
            function calculData() {
                var data = [
                    @foreach($delai as $d)
                    {{$d->delai}},
                    @endforeach
                ];
                var sum = [];
                for (var i = 0; i < data.length; i++) {
                    for (var j = 0; j < data[i].length; j++) {
                        if (sum[j] == undefined || sum[j].value == undefined)sum[j] = {"value": 0, "label": ""};
                        sum[j].value += data[i][j];
                    }
                }
                for (var k = 0; k < sum.length; k++) {
                    sum[k].label = "Page " + k;
                    sum[k].value = sum[k].value / data.length;
                }
                return sum;
            }

        })();


        @foreach($questions as $key => $q)

        (function () {

            nv.addGraph(function () {
                var chart = nv.models.pieChart()
                        .x(function (d) {
                            return d.label
                        })
                        .y(function (d) {
                            return d.value
                        })
                        .color([$.Pages.getColor('success'), $.Pages.getColor('danger'), $.Pages.getColor('primary'), $.Pages.getColor('complete'),])
                        .showLabels(true);

                d3.select("#question{{$key}} svg")
                        .datum(calculData())
                        .transition().duration(350)
                        .call(chart);
                nv.utils.windowResize(chart.update);
                return chart;
            });
            function calculData() {
                var rep = JSON.parse($('<div/>').html("{{$q->response}}").text());
                var rep2 = rep;
                var x = [];
                @foreach($q->reps as $r)
                x.push({
                    "label": rep[{{$r->repindex}}],
                    "value":{{$r->total}}
                });
                @endforeach

                return x;
            }

        })();

        @endforeach

    </script>
@endsection