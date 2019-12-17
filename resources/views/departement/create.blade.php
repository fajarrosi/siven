@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>tambah departement</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Tambah departement</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('departement.store') }}" method="post">
   @csrf

   <div class="box-body">
    <div class="form-group">
      <label for="name">nama departement </label>
      <input type="text" name="name" class="form-control" id="name" placeholder="masukkan nama">
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

@stop