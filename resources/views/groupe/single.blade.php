@extends('blank')

@section('content')


    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
                <h1>Groupe : {{$groupe->nom}}</h1>
            </div>
        </div>
        <div class="panel-body">
            <p>
                {{$groupe->description}}
            </p>

                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4 col-xs-12 pull-right">
                                <input type="text" id="search-table" class="form-control" placeholder="Chercher">
                            </div>
                            <div class="col-md-4 col-xs-12 pull-right">
                                <a id="show-modal" href="#" data-toggle="modal" data-target="#linkModal" class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i> Ajouter</a>
                            </div>

                        </div>


                        <div class="clearfix">
                        </div>
                    </div>
                    <div class="panel-body">


                        <table id="tableWithSearch" class="table table-hover demo-table-search" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($groupe->personnels as $key => $value)
                                <tr>
                                    <td>
                                        <a href="{{ URL::to('groupe',$value->id) }}">
                                            {{ $value->nom }}
                                        </a>
                                    </td>
                                    <td>0</td>
                                    <td>
                                        <a href="{{ url('groupe', array($groupe, 'unlinkUser',$value->id)) }}">
                                            <i class="fa fa-trash"></i> Supprimer
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



    <!-- Modal Link-->
    <div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content-wrapper">
                <div class="modal-content">
                    <div class="modal-header clearfix text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
                        </button>
                        <h5>Mise à jour du Presentation</h5>
                    </div>
                    <form role="form" method="post" action="{{ url('groupe', array($groupe, 'linkUser')) }}" accept-charset="UTF-8">
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


@endsection


@section('js')


    <script src="{{ URL::asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/datatables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/lodash.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/datatables.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/bootstrap-select2/select2.min.js')}}"></script>
    <script>
        $("#multi").select2();
    </script>

@endsection