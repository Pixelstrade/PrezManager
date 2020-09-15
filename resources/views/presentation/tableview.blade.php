@extends('blank')


@section('content')


    <div class="panel">
        <div class="panel-heading">

            <div class="row">
                <div class="col-md-4 col-xs-12 pull-right">
                    <input type="text" id="search-table" class="form-control" placeholder="Chercher">
                </div>
                <div class="col-md-4 col-xs-12 pull-right">
                    <a id="show-modal" href="{{ URL::to('presentation/create') }}" class="btn btn-primary btn-cons pull-right"><i class="fa fa-plus"></i> Ajouter</a>
                </div>

            </div>


            <div class="clearfix">
            </div>

        </div>
        <div class="panel-body">


                <table id="tableWithSearch" class="table table-hover demo-table-search" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Version</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($presentations as $key => $value)
                        <tr>
                            <td>
                                <a href="{{ URL::to('presentation',$value->id) }}">
                                <img src="{{ URL::asset($value->ThumURI)}}" width="100px" alt=""/>
                                    </a>
                            </td>
                            <td>
                                <a href="{{ URL::to('presentation',$value->id) }}">
                                {{ $value->nom }}
                                    </a>
                            </td>
                            <td>
                                <a href="{{ URL::to('presentation',$value->id) }}">
                                {{ $value->version }}
                                    </a>
                            </td>

                            <td>
                                <a href="{{ url('presentation', array($value->id, 'delete')) }}">
                                    <i class="fa fa-trash"></i> Supprimer
                                </a>
                            </td>
                            <td>
                                <a href="{{ url('presentation', array($value->id, 'edit')) }}">
                                    <i class="fa fa-pencil"></i> Modifier
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
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