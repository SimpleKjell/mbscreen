@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Kampagnen</h1>




  @if(count($kampagnes) > 0)

  <table class="table table-hover">
    <caption>Übersicht der Feeds</caption>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Kunde</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>

      @if($kampagnes)
        @foreach($kampagnes as $kampagne)
          <?php $kunde = $kampagne->kunde()->first(); ?>
          <tr>
            <th scope="row">{{$kampagne->id}}</th>
            <td>{{$kampagne->title}}</td>
            <td>{{($kunde) ? $kunde->title : ''}}</td>
            <td>
              <div class="float-right">
                <a href="/admin/kampagnen/{{$kampagne->id}}/edit" class="btn btn-info">Bearbeiten</a>

                {!! Form::open(['action' => ['KampagnenController@destroy', $kampagne->id], 'method' => 'POST', 'class'=> "d-inline-block"]) !!}

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
      Keine Kampagnen vorhanden.
    </p>
  @endif

  <a href="/admin/kampagnen/create" class="mt-md-3 btn btn-block btn-info" >Weitere Kampagne hinzufügen</a>

@endsection
