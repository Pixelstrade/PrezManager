@extends('blank')

@section('content')


    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
                Ajouter un nouvel groupe
            </div>
        </div>
        <div class="panel-body">
            {{ HTML::ul($errors->all()) }}

            {!! Form::open(array('url' => 'groupe')) !!}

            <div class="form-group">
                {!! Form::label('nom', 'Nom') !!}
                {!! Form::text('nom', Input::old('nom'), array('required','class' => 'form-control')) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', Input::old('description'), array('required','class' => 'form-control')) !!}
            </div>


            {!! Form::submit('Create Groupe ', array('class' => 'btn btn-primary')) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection