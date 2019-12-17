@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Detail Role</h1>
@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif

<div class="flex-container">
    <div class="columns m-t-10">
      <div class="column">
        <h1 class="title">{{$roles->display_name}}<small class="m-l-25"><em>({{$roles->name}})</em></small></h1>
        <h5>{{$roles->description}}</h5>
      </div>
    </div>

    <div class="columns">
      <div class="column">
        <div class="box">
          <article class="media">
            <div class="media-content">
              <div class="content">
                <h2 class="title">Permissions:</h1>
                <ul>
                  @foreach ($roles->permissions as $r)
                    <li>{{$r->display_name}} </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
@stop



@section('css')
@stop

@section('js')
<script> console.log('Hi!'); </script>

@stop