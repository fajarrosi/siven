@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Edit user</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit user</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('user.update',$user->id) }}" method="post">
   @csrf
   @method('PUT')

   <div class="box-body">
    <div class="form-group">
      <label for="name">nama </label>
      <input type="text" name="name" class="form-control" id="name" placeholder="masukkan nama" value="{{$user->name}}">
    </div>
    @if($errors->has('name'))
    <div class="text-danger">
      {{ $errors->first('name')}}
    </div>
    @endif
    <div class="form-group">
      <label for="email">email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="masukkan email " value="{{$user->email}}">
    </div>
    @if($errors->has('email'))
    <div class="text-danger">
      {{ $errors->first('email')}}
    </div>
    @endif
    <div class="form-group">  
      <label for="role_id">Role</label>
      <select class="form-control" id="role_id" name="role_id">
        @if(count($roles))
        @foreach($roles as $row)
        <option value="{{$row->id}}" {{$row->id == $user->roles[0]->id ? 'selected="selected"' : ''}}>{{$row->name}}</option>
        @endforeach
        @endif
      </select>
      @if ($errors->has('role_id'))
      <span class="help-block">{{ $errors->first('role_id') }}</span>
      @endif
    </div>

  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
  <!-- box-footer -->

</form>


</div>
<!-- box -->

@stop

@section('css')

@stop

@section('js')
<script> console.log('Hi!'); </script>

@stop