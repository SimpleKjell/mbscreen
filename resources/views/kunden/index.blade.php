@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Kunden</h1>

  @if(count($kunden) > 0)

  <table class="table table-hover">
    <caption>Übersicht der Kunden</caption>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>

      @if($kunden)
        @foreach($kunden as $kunde)

          <tr>
            <th scope="row">{{$kunde->id}}</th>
            <td>{{$kunde->title}}</td>
            <td>
              <div class="float-right">
                <a href="/admin/kunden/{{$kunde->id}}/edit" class="btn btn-info">Bearbeiten</a>

                {!! Form::open(['action' => ['KundenController@destroy', $kunde->id], 'method' => 'POST', 'class'=> "d-inline-block"]) !!}

                  {{Form::hidden('_method', 'DELETE')}}
                  {{Form::submit('Löschen', ['class' => 'btn btn-danger'])}}

                {!! Form::close() !!}
              </div>
            </td>
          </tr>

        @endforeach
      @endif
    </tbody>
  </table>

  @else
    <p>
      Keine Kunden vorhanden.
    </p>
  @endif

  <a href="/admin/kunden/create" class="mt-md-3 btn btn-block btn-info" >Weiteren Kunden hinzufügen</a>

@endsection
