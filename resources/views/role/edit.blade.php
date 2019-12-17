@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Edit role</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit role</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('role.update',$role->id) }}" method="post">
   @csrf
   @method('PUT')

   <div class="box-body">
    <div class="form-group">
      <label for="name">nama role</label>
      <input type="text" name="name" class="form-control" id="name" placeholder="masukkan nama" value="{{$role->name}}">
    </div>
    @if($errors->has('name'))
    <div class="text-danger">
      {{ $errors->first('name')}}
    </div>
    @endif
    <div class="form-group">
      <label for="display_name">display_name</label>
      <input type="display_name" name="display_name" class="form-control" id="display_name" placeholder="masukkan display_name " value="{{$role->display_name}}">
    </div>
    @if($errors->has('display_name'))
    <div class="text-danger">
      {{ $errors->first('display_name')}}
    </div>
    @endif


  </div>
  <!-- /.box-body -->



</div>
<!-- box -->


<div class="box">
  <div class="box-header">
    <h3 class="box-title"> Permissions</h3>
    
  </div><!-- box header -->
  <div class="box-body">
    <div class="form-check">
    @if(count($permissions))
      @foreach ($permissions as $p)

    <label class="form-check-label">
      <input type="checkbox" class="form-check-input" value="{{$p->id}}" id="p"  name="p[]"  {{ in_array($p->id,$role_permission)  ? 'checked' : '' }}>{{$p->name}}</input>
    </label>  
  </br>
    @endforeach
    @endif




    <!-- $role->permissions->pluck('id')[1] -->

  </div>
<!-- form check -->

</div>
<!-- box body -->

</div>
<!-- box -->
  

    <button type="submit" class="btn btn-primary">Submit</button>
  

</form>


@stop

@section('css')

@stop

@section('js')

@stop