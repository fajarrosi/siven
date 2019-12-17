@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Edit permission</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit permission</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('permission.update',$permission->id) }}" method="post">
   @csrf
   @method('PUT')

   <div class="box-body">
    <div class="form-group">
      <label for="name">nama role</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="masukkan nama" value="{{$permission->name}}">
    </div>
    @if($errors->has('name'))
    <div class="text-danger">
      {{ $errors->first('name')}}
    </div>
    @endif
    <div class="form-group">
      <label for="display_name">display_name</label>
      <input type="display_name" name="display_name" class="form-control" id="display_name" placeholder="masukkan display_name " value="{{$permission->display_name}}">
    </div>
    @if($errors->has('display_name'))
    <div class="text-danger">
      {{ $errors->first('display_name')}}
    </div>
    @endif


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