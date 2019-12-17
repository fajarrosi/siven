@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Edit stok</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit stok</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('stok.update',$stok->id) }}" method="post">
   @csrf
   @method('PUT')

   <div class="box-body">

    <div class="form-group">  
      <label for="item_id">Barang</label>
      <select class="form-control" id="item_id" name="item_id">
        @if(count($items))
        @foreach($items as $row)
        <option value="{{$row->id}}" {{$row->id == $stok->items_id ? 'selected="selected"' : ''}}>{{$row->name}}</option>
        @endforeach
        @endif
      </select>
      @if ($errors->has('item_id'))
      <span class="help-block">{{ $errors->first('item_id') }}</span>
      @endif
    </div>

        <div class="form-group">
      <label for="total">total </label>
      <input type="text" name="total" class="form-control" id="total" placeholder="masukkan total" value="{{$stok->total}}">
    </div>
    @if($errors->has('total'))
    <div class="text-danger">
      {{ $errors->first('total')}}
    </div>
    @endif

    <div class="form-group">  
      <label for="kondisi_id">Kondisi</label>
      <select class="form-control" id="kondisi_id" name="kondisi_id">
        @if(count($cond))
        @foreach($cond as $row)
        <option value="{{$row->id}}" {{$row->id == $stok->conds_id ? 'selected="selected"' : ''}}>{{$row->name}}</option>
        @endforeach
        @endif
      </select>
      @if ($errors->has('kondisi_id'))
      <span class="help-block">{{ $errors->first('kondisi_id') }}</span>
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

@stop