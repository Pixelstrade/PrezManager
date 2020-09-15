@extends('blank')

@section('content')


    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
                Ajouter un nouvel personnel
            </div>
        </div>
        <div class="panel-body">
{{ HTML::ul($errors->all()) }}

{!! Form::open(array('url' => 'personnel')) !!}

<div class="form-group">
    {!! Form::label('nom', 'Nom') !!}
    {!! Form::text('nom', Input::old('nom'), array('required','class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('prenom', 'Prenom') !!}
    {!! Form::text('prenom', Input::old('prenom'), array('required','class' => 'form-control')) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', Input::old('email'), array('required','class' => 'form-control')) !!}
</div>

<div class="form-group">
    {!! Form::label('password', 'Mot de passe') !!}
    {!! Form::password('password', array('required','class' => 'form-control')) !!}
</div>


{!! Form::submit('Create Personnel ', array('required','class' => 'btn btn-primary')) !!}

{!! Form::close() !!}
</div>
    </div>

@endsection