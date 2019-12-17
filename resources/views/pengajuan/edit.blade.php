@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Edit pengajuan</h1>
@stop

@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Edit pengajuan</h3>
  </div>
  <!-- box-header -->
  

  <form action="{{ route('pngjuan.update',$pngjuan->id) }}" method="post">
   @csrf
   @method('PUT')

   <div class="box-body">

    <div class="form-group">  
      <label for="item_id">Barang</label>
      <select class="form-control" id="item_id" name="item_id">
        @if(count($item))
        @foreach($item as $row)
        <option value="{{$row->id}}" {{$row->id == $pngjuan->item_id ? 'selected="selected"' : ''}}>{{$row->name}}</option>
        @endforeach
        @endif
      </select>
      @if ($errors->has('item_id'))
      <span class="help-block">{{ $errors->first('item_id') }}</span>
      @endif
    </div>
    <div class="form-group">
      <label for="total">total </label>
      <input type="text" name="total" class="form-control" id="total" placeholder="masukkan total" value="{{$pngjuan->total}}">
    </div>
    @if($errors->has('total'))
    <div class="text-danger">
      {{ $errors->first('total')}}
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