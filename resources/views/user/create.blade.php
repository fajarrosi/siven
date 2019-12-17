@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>tambah user</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Tambah user</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('user.store') }}" method="post">
   @csrf

   <div class="box-body">
    <div class="form-group">
      <label for="name">nama </label>
      <input type="text" name="name" class="form-control" id="name" placeholder="masukkan nama">
      @if ($errors->has('name'))
                <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
    </div>

    <div class="form-group">
      <label for="email">email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="masukkan email ">
       @if ($errors->has('email'))
                <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Password ">
    </div>
    <div class="form-group">
      <label for="role">Role</label>
 <select class="form-control" id="role_id" name="role_id">
                    @if(count($roles)) @foreach($roles as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach @endif
                </select>
                @if ($errors->has('role_id'))
                <span class="help-block">{{ $errors->first('role_id') }}</span>
                @endif
    </div>

        <div class="form-group">
      <label for="departement">Departement</label>
 <select class="form-control" id="departement" name="departement">
                    @if(count($departements)) 
                    @foreach($departements as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach @endif
                </select>
                @if ($errors->has('departement'))
                <span class="help-block">{{ $errors->first('departement') }}</span>
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