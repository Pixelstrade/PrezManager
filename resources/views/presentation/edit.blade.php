@extends('blank')

@section('content')


    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
                Modifier Présentation
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">

            {{ HTML::ul($errors->all()) }}
            {!! Form::model($presentation,array('route' => array('presentation.update', $presentation->id), 'method' => 'PUT')) !!}

            <div class="form-group">
                {!! Form::label('nom', 'Nom') !!}
                {!! Form::text('nom', Input::old('nom'), array('class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', Input::old('description'), array('class' => 'form-control')) !!}
            </div>


            {!! Form::submit('Mise à jour du Presentation ', array('class' => 'btn btn-primary')) !!}

            {!! Form::close() !!}
            </div>
                <div class="col-md-4"></div>
                    <img src="/{{$presentation->ThumURI}}" alt=""/>
                </div>

        </div>
    </div>
@endsection