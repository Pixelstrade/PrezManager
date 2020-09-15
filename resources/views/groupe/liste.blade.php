@extends('blank')



@section('content')
    <div class="container-fluid container-fixed-lg bg-white">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <h1>Liste de Groupe</h1>
                </div>


                <div class="row">
                    <div class="col-md-4 col-xs-12 pull-right">
                        <input type="text" id="search-table" class="form-control" placeholder="Chercher">
                    </div>
                    <div class="col-md-4 col-xs-12 pull-right">
                        <a id="show-modal" href="{{ url('groupe/create') }}" class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i> Ajouter</a>
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
                        <th>Nombre de personnels</th>

                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($groupes as $key => $value)
                        <tr>
                            <td>
                                <a href="{{ URL::to('groupe',$value->id) }}">
                                {{ $value->nom }}
                                    </a>
                            </td>
                            <td>{{count($value->personnels)}}</td>
                            <td>
                                <a href="{{ url('groupe', array($value->id, 'delete')) }}">
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

@endsection

@section('js')

    <script src="{{ URL::asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/datatables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables-responsive/js/lodash.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/datatables.js')}}" type="text/javascript"></script>

@endsection