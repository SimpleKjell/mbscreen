@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">Socials</h1>


  <table class="table table-hover marginTopMedium">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>

      @if(count($socials) > 0)

        @foreach($socials as $social)

        <tr>
          <th scope="row">{{$social->id}}</th>
          <td>{{$social->social}}</td>
          <td>
            <div class="float-right">
              <a href="/admin/socials/{{$social->id}}" class="btn btn-info">Bearbeiten</a>

              {!! Form::open(['action' => ['SocialController@destroy', $social->id], 'method' => 'POST', 'class'=> "d-inline-block"]) !!}

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

  <a href="/admin/socials/create" class="mt-md-3 btn btn-block btn-info" >Weitere Verbindung hinzufügen</a>

@endsection
