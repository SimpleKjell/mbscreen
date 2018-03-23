@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Feeds</h1>


  <table class="table table-hover">
    <caption>Übersicht der Feeds</caption>
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name der Page</th>
      <th scope="col">Anzahl anzuzeigender Posts</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

    @if($feeds)
      @foreach($feeds as $feed)

        <tr>
          <th scope="row">{{$feed->id}}</th>
          <td>{{$feed->feed_url}}</td>
          <td>{{$feed->anz_posts}}</td>
          <td class="float-right">
            <a href="/admin/feeds/{{$feed->id}}/edit" class="btn btn-info">Bearbeiten</a>

            {!! Form::open(['action' => ['FeedsController@destroy', $feed->id], 'method' => 'POST', 'class'=> "d-inline-block"]) !!}

              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Löschen', ['class' => 'btn btn-danger'])}}

            {!! Form::close() !!}
          </td>
        </tr>

      @endforeach
    @endif
  </tbody>
</table>




  <a href="/admin/feeds/create" class="btn btn-info btn-block mt-md-3">Weitere Page hinzufügen</a>



@endsection
