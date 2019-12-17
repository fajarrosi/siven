@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Tambah Barang</button>
@stop

@section('content')


<div class="box">
	<div class="box-header">
		<h3 class="box-title">Detail Barang</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="itemdetail" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>kode inventarisasi</th>
					<th>Name</th>
					<th>Kondisi</th>
					<th>Actions</th>
				</tr>
			</thead>			
		</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->


<div id="formModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Status File Upload</h4>
			</div>
			<div class="modal-body">
				<span id="form_result"></span>

				<form method="post" id="stat" class="form-horizontal" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label class="control-label col-md-4">kode inventarisasi : </label>
						<div class="col-md-8">
							<input type="text" name="kode_item" id="kode_item" class="form-control" placeholder="Masukkan kode inventarisasi"/>
						</div>
					</div>
					<div class="form-group">
						<label for="items_id" class="control-label col-md-4">Barang :</label>
						<div class="col-md-8">
							<select class="form-control" id="item_id" name="item_id">

								@if(count($item)) @foreach($item as $row)
								<option value="{{$row->id}}">{{$row->name}}</option>
								@endforeach @endif
								<option value="other">Other</option>
							</select>
						</div>
						@if ($errors->has('items_id'))
						<span class="help-block">{{ $errors->first('items_id') }}</span>
						@endif
					</div>
					<div id="additem" class="form-group">
						<label for="new" class="control-label col-md-4">Tambah Barang baru :</label>
						<div class="col-md-8">
							<input type="text" name="new" id="new" placeholder="Masukkan Nama Barang" class="form-control"/>
						</div>
					</div>
					<div class="form-group">
						<label for="cond_id" class="control-label col-md-4">Kondisi :</label>
						<div class="col-md-8">
							<select class="form-control" id="cond_id" name="cond_id">

								@if(count($kondisi)) @foreach($kondisi as $row)
								<option value="{{$row->id}}">{{$row->name}}</option>
								@endforeach @endif
							</select>
						</div>
						@if ($errors->has('cond_id'))
						<span class="help-block">{{ $errors->first('cond_id') }}</span>
						@endif
					</div>

					<br />
					<div class="form-group" align="center">
						<input type="hidden" name="action" id="action" />
						<input type="hidden" name="hidden_id" id="hidden_id" />
						<input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modal-title">Confirmation</h2>
			</div>
			<div class="modal-body">
				<h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
			</div>
			<div class="modal-footer">
				<button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

@stop



@section('css')
@stop

@section('js')
<script>
	$(function () {
				$('#create_record').click(function(){
			$('.modal-title').text("Tambah Status File Upload");
			$('#action_button').val("Tambah");
			$('#kode_item').val("");
			$('#item_id').val("select barang");
			$('#cond_id').val("select kondisi");
			$('#action').val("Add");
			$('#formModal').modal('show');
			$('#additem').hide();
			$('#form_result').hide();
			
		});
		 $('#item_id').on('change',function(){

      if($(this).find(":selected").val() == 'other'){
      		$('#additem').show();
      }else{
			$('#additem').hide();

      }

    });
		$('#itemdetail').DataTable({
			processing: true,
			serverSide: true,
			ajax:{
				url: "{{ route('itemdetail.index') }}",
			},
			columns:[
			{
				data: 'kode_item',
				name: 'kode_item'
			},
			{
				data: 'itemname',
				name: 'itemname'
			},
			{
				data: 'kondisi',
				name: 'kondisi'
			},
			{
				data: 'action',
				name: 'action',
				orderable: false
			}
			]
		});

		$('#stat').on('submit', function(event){
			event.preventDefault();
			if($('#action').val() == 'Add')
			{
				$.ajax({
					url:"{{ route('itemdetail.store') }}",
					method:"POST",
					data: new FormData(this),
					contentType: false,
					cache:false,
					processData: false,
					dataType:"json",
					success:function(data)
					{
						var html = '';
						if(data.errors)
						{
							html = '<div class="alert alert-danger">';
							for(var count = 0; count < data.errors.length; count++)
							{
								html += '<p>' + data.errors[count] + '</p>';
							}
							html += '</div>';
						}
						if(data.success)
						{
							$('#form_result').show();
							html = '<div class="alert alert-success">' + data.success + '</div>';
							setTimeout(function(){

							$('#itemdetail').DataTable().ajax.reload();

							$('#formModal').modal('hide');
							}, 2000);
							
						}
						$('#form_result').html(html);
					}
				})
			}

			if($('#action').val() == "Edit")
			{
				$.ajax({
					url:"{{ route('item-detail.update') }}",
					method:"POST",
					data:new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					dataType:"json",
					success:function(data)
					{
						var html = '';
						if(data.errors)
						{
							html = '<div class="alert alert-danger">';
							for(var count = 0; count < data.errors.length; count++)
							{
								html += '<p>' + data.errors[count] + '</p>';
							}
							html += '</div>';
						}
						if(data.success)
						{
							html = '<div class="alert alert-success">' + data.success + '</div>';
							$('#form_result').show();

							setTimeout(function(){
							$('#formModal').modal('hide');
							$('#itemdetail').DataTable().ajax.reload();
							},2000);

						}
						$('#form_result').html(html);
					}
				});
			}
		});
		$(document).on('click', '.edit', function(){
			var id = $(this).attr('id');
			$('#form_result').html('');
			$.ajax({
				url:"/itemdetail/"+id+"/edit",
				dataType:"json",
				success:function(html){
					$('#kode_item').val(html.data.kode_item);
					$('#item_id').val(html.data.item_id);
					$('#cond_id').val(html.data.cond_id);
					$('#hidden_id').val(html.data.id);
					$('.modal-title').text("Edit New Record");
					$('#action_button').val("Edit");
					$('#action').val("Edit");
					$('#formModal').modal('show');
					$('#additem').hide();
							$('#form_result').show();

				}
			})
		});
		var user_id;

		$(document).on('click', '.delete', function(){
			user_id = $(this).attr('id');
			console.log(user_id);
			$('#confirmModal').modal('show');
			$('.modal-title').text("Confirmation");
			
			$('#ok_button').text('Delete');

		});

		$('#ok_button').click(function(){
			$.ajax({
				url:"itemdetail/destroy/"+user_id,
				beforeSend:function(){
					$('#ok_button').text('Deleting...');
				},
				success:function(data)
				{
					setTimeout(function(){
						$('#confirmModal').modal('hide');
						$('#itemdetail').DataTable().ajax.reload();
					}, 2000);
				}
			})
		});
	});
</script>
@stop