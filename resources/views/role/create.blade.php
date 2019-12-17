@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Tambah Role</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Detail Role</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('role.store') }}" method="post">
   @csrf

   <div class="box-body">
    <div class="form-group">
      <label for="name">nama role</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="masukkan nama">
    </div>
    <div class="form-group">
      <label for="display-name">display-nama</label>
      <input type="display-name" name="display_name" class="form-control" id="display_name" placeholder="masukkan display-name ">
    </div>


  </div>

  <!-- /.box-body -->

</div>
<!-- box -->


<div class="box">
  <div class="box-header">
    <h3 class="box-title"> Permissions</h3>
    
  </div>
  <div class="box-body">
    <div class="form-check">
      @foreach ($permissions as $p)

      <label class="form-check-label">
        <input type="checkbox" class="form-check-input" value="{{$p->id}}" id="p" name="p[]">{{$p->display_name}}</input>
      </label>
    </br>
    @endforeach


  </div>
</div>


</div>
<button type="submit" class="btn btn-primary">Submit</button>

</form>


@stop

@section('css')

@stop

@section('js')
<script> console.log('Hi!'); </script>


@stop