@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Persetujuan</h1>

@stop

@section('content')
@if(session('status'))
<div class="alert alert-success">{{ session('status')}}</div>
@endif

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Persetujuan</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Departement</label>
					<select class="form-control" id="departement" name="departement">
						<option>Select Departement</option>
						@if(count($departement)) @foreach($departement as $row)
						<option value="{{$row->name}}">{{$row->name}}</option>
						@endforeach @endif
					</select>
					@if ($errors->has('departement'))
					<span class="help-block">{{ $errors->first('departement') }}</span>
					@endif
				</div>

				<div class="form-group" >
					<button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>

					<button type="button" name="reset" id="reset" class="btn btn-default">Reset</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table id="prstjuan" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nama Peralatan</th>
							<th>Jumlah</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
				<!-- table-responsive -->

			</div> 
			<!-- col-md-12 -->

		</div> <!-- row -->
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->

<div id="confirmModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modal-title"></h2>
			</div>
			<div class="modal-body">
				<h4 align="center" style="margin:0;">Anda yakin akan menyetujui item ini  ?</h4>
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
		fill_datatable();

		function fill_datatable(departement = '')
		{
			var dataTable = $('#prstjuan').DataTable({
				processing: true,
				serverSide: true,
				ajax:{
					url: "{{ route('prstjuan.index') }}",
					data:{departement:departement}
				},
				columns: [
				{
					data:'item_name',
					name:'item_name'
				},
				{
					data:'total',
					name:'total'
				},
				{
					data: 'action',
					name: 'action',
					orderable: false
				}
				]
			});
    }//end fill_datatable

    var user_id;

    $(document).on('click', '.delete', function(){
    	user_id = $(this).attr('id');
    	console.log(user_id);
    	$('#confirmModal').modal('show');
    });

    $('#ok_button').click(function(){
    	$.ajax({
    		url:"/prstjuan/destroy/"+user_id,
    		beforeSend:function(){
    			$('#ok_button').text('Deleting...');
    		},
    		success:function(data)
    		{
    			setTimeout(function(){
    				$('#confirmModal').modal('hide');
    				$('#prstjuan').DataTable().ajax.reload();
    			}, 2000);
    		}
    	})
    });

    $('#filter').click(function(){
    	var departement = $('#departement').val();

    	if(departement != '')
    	{
    		$('#prstjuan').DataTable().destroy();
    		fill_datatable(departement);
    	}
    	else
    	{
    		alert('Select Both filter option');
    	}
    });//filter

    $('#reset').click(function(){
    	$('#departement').val('Select Departement');
    	$('#prstjuan').DataTable().destroy();
    	fill_datatable();
    });
		// $('#pngs').dataTable({
		// 	initComplete: function () {
		// 		this.api().columns().every( function () {
		// 			var column = this;
		// 			var select = $('<select><option value=""></option></select>')
		// 			.appendTo('departement')
		// 			.on( 'change', function () {
		// 				var val = $.fn.dataTable.util.escapeRegex(
		// 					$(this).val()
		// 					);

		// 				column
		// 				.search( val ? '^'+val+'$' : '', true, false )
		// 				.draw();
		// 			} );

		// 			column.data().unique().sort().each( function ( d, j ) {
		// 				select.append( '<option value="'+d+'">'+d+'</option>' )
		// 			} );
		// 		} );
		// 	}
		// });
	});

</script>
@stop