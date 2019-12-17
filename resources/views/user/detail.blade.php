@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1> Halaman {{$user->name}}</h1>
@stop

@section('content')

<div class="col-md-6">
<div class="box">
	<div class="box-header">
		<h3 class="box-title" >{{$user->name}} Detail </h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="user" class="table table-bordered table-striped">
			<tbody>
				<tr>
					<td style="text-align: right; font-weight:800" width="50%">name user
					</td>
					<td style="text-align: left">
						{{ $user->name}}
						
					</td>
				</tr>
				<tr>
					<td style="text-align: right; font-weight:800" width="50%">
						email user
					</td>
					<td style="text-align: left;"> 
						{{$user-> email}}
					</td>
				</tr>
				<tr>
					<td style="text-align: right;font-weight:800" width="50%">
						departement
					</td>
					<td style="text-align: left;"> 
						{{$d}}
					</td>
				</tr>
			</tbody>
			
		</table>
	</div>
	<!-- /.box-body -->
</div>
</div>
<!-- /.box -->
@stop



@section('css')
@stop

@section('js')

@stop