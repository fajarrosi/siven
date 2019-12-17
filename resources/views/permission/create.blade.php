@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>tambah permission</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Tambah permission</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('permission.store') }}" method="post">
   @csrf

   <div class="box-body">
    <div class="form-group">
      <label for="name">nama permission </label>
      <input type="text" name="name" class="form-control" id="name" placeholder="masukkan nama">
    </div>
    <div class="form-group">
      <label for="display-name">display-nama</label>
      <input type="display-name" name="display_name" class="form-control" id="display_name" placeholder="masukkan display-name ">
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