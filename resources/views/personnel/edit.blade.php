@extends('blank')

@section('content')


    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
                Modifier Personnel
            </div>
        </div>
        <div class="panel-body">
            {{ HTML::ul($errors->all()) }}
            {!! Form::model($personnel,array('route' => array('personnel.update', $personnel->id), 'method' => 'PUT')) !!}
            <div class="form-group">
                {!! Form::label('nom', 'Nom') !!}
                {!! Form::text('nom', Input::old('nom'), array('class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('prenom', 'Prenom') !!}
                {!! Form::text('prenom', Input::old('prenom'), array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::text('email', Input::old('email'), array('class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Mot de passe') !!}
                {!! Form::password('password', array('class' => 'form-control')) !!}
            </div>


            {!! Form::submit('Mettre à jour Personnel ', array('class' => 'btn btn-primary')) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection