@extends('blank')

@section('content')


    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 pull-right">
            <div class="btn-group btn-group-justified ">

                <div class="btn-group">
                    <a type="button" class="btn btn-default btn-danger" href="{{ url('presentationtable') }}">
                        <span class="p-t-5 p-b-5">
                        <i class="fa  fa-list fs-15"></i>
                        </span>
                        <br>
                        <span class="fs-11 font-montserrat text-uppercase">Vue Table</span>
                    </a>
                </div>

            </div>
        </div>
    </div>


<div class="flex-wrap presentationcontainer">
    <a href="{{ URL::to('presentation/create') }}"><div class="addbox">
        <i class="pg-plus"></i>
    </div></a>
@foreach($presentations as $key => $value)

    <div>
        {{--<h1>{{$value->nom}}</h1>--}}
        <a href="{{ URL::to('presentation',$value->id) }}">
            <img src="/{{$value->ThumURI}}" alt=""/>
            <h1 class="title">{{$value->nom}}</h1>
        </a>
    </div>
@endforeach
</div>

@endsection