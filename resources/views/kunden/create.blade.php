@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Erstelle Kunde</h1>

    {!! Form::open(['action' => 'KundenController@store', 'method' => 'POST'] ) !!}
        <hr>
        <h3 class="marginTopMedium">Bezeichnung</h3>
        <div class="form-group marginTopMedium">
          {{Form::label('title', 'Name')}}
          {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Name des Kundens'])}}
        </div>

        {{Form::submit('Absenden', ['class' => 'btn btn-info btn-block marginTopMedium'])}}
    {!! Form::close() !!}




@endsection
