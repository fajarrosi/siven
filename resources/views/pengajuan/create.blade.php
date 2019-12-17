@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>tambah pengajuan</h1>
@stop

@section('content')
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Tambah pengajuan</h3>
	</div>
	<!-- box-header -->
	

  <form action="{{ route('pngjuan.store') }}" method="post">
   @csrf

   <div class="box-body">
    <div class="form-group">
      <label for="barang">Barang</label>
      <select class="form-control" id="barang_id" name="barang_id">
        @if(count($data)) @foreach($data as $row)
        <option value="{{$row->id}}">{{$row->name}}</option>
        @endforeach @endif
        <option value="other">Other</option>

      </select>
      @if ($errors->has('barang_id'))
      <span class="help-block">{{ $errors->first('barang_id') }}</span>
      @endif
    </div>
    <div id="additem" class="hidden">
      <label for="new" >Tambah Barang baru </label>

      <input type="text" name="new" id="new" placeholder="Masukkan Nama Barang" class="form-control"/>
    </div>
    <div class="form-group" >
      <label for="total">Jumlah </label>
      <input type="text" name="total" class="form-control" id="total" placeholder="masukkan total">

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
<script> 
  $(function () {
    $('#barang_id').on('change',function(){

      if($(this).find(":selected").val() == 'other'){

        $('#additem').attr('class','form-group');
      }else{
        $('#additem').attr('class','hidden');
      }

    });

  });
</script>

@stop