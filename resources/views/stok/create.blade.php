@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>tambah stok</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Tambah stok</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('stok.store') }}" method="post">
   @csrf

   <div class="box-body">
        <div class="form-group">
      <label for="items_id">Barang</label>
 <select class="form-control" id="items_id" name="items_id">
                    @if(count($item)) @foreach($item as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach @endif
                </select>
                @if ($errors->has('items_id'))
                <span class="help-block">{{ $errors->first('items_id') }}</span>
                @endif
    </div>


    <div class="form-group">
      <label for="total">Total </label>
      <input type="text" name="total" class="form-control" id="total" placeholder="masukkan total">
    </div>

          <label for="conds_id">Kondisi</label>
 <select class="form-control" id="conds_id" name="conds_id">
                    @if(count($cond)) @foreach($cond as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach @endif
                </select>
                @if ($errors->has('conds_id'))
                <span class="help-block">{{ $errors->first('conds_id') }}</span>
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