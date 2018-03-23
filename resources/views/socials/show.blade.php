@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">{{$social->social}}</h1>

  @if($social->social == 'Twitter')

  <p>
    Es kann jede Twitter ID / Username eingetragen werden.<br>
    Es wird kein Adminzugang benötigt.
  </p>

  @elseif($social->social == 'Facebook')

  <p>
    Es werden nur Facebook Pages ausgelesen, deren Admin verknüpft ist.
  </p>

  @endif


  <table class="table table-hover marginTopMedium">
    <caption>Übersicht der {{$social->social}} Pages</caption>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name der Page</th>
        <th scope="col">Anzahl anzuzeigender Posts</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($social->socialInstances as $instance)

        <tr>
          <th scope="row">{{$instance->id}}</th>
          <td>{{$instance->title}}</td>
          <td>{{$instance->anz_posts}}</td>
          <td>
            <div class="float-right">
              <a href="/admin/socials/{{$social->id}}/i/{{$instance->id}}/edit" class="btn btn-info">Bearbeiten</a>

              {!! Form::open(['action' => ['SocialInstancesController@destroy', $social->id, $instance->id], 'method' => 'POST', 'class'=> "d-inline-block"]) !!}

              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Löschen', ['class' => 'btn btn-danger'])}}

              {!! Form::close() !!}
            </div>
          </td>
        </tr>

      @endforeach

    </tbody>
  </table>




  <a href="/admin/socials/{{$social->id}}/i/create" class="btn btn-info btn-block mt-md-3">Weitere Page hinzufügen</a>



@endsection
