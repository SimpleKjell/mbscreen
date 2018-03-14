@extends('layouts.admin')

@section('content')

  <h1 class="mb-md-3">{{$social->social}}</h1>

  @foreach($social->socialInstances as $instance)

    {{$instance->title}}

  @endforeach



@endsection
