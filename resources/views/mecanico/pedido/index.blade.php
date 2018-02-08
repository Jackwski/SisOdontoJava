@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>LISTADO DE PEDIDOS<a href="pedido/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('mecanico.pedido.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						
						<th>Fecha</th>
						<th>Mecanico</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
					<!-- bucle -->
					@foreach ($pedidos as $ped)
					<tr>
						<td>{{$ped->fecha_hora}}</td>
						<td>{{$ped->nombre}}</td>
						@if ($ped->estado=='Activo')
						<td><small class="label pull-right bg-green">{{$ped->estado}}</small></td>
						@elseif ($ped->estado=='Pendiente')
						<td><small class="label pull-right bg-yellow">{{$ped->estado}}</small></td>
						@else
						<td><small class="label pull-right bg-red">{{$ped->estado}}</small></td>
						@endif
						<td>
							<a href="{{URL::action('PedidoController@show', $ped->idpedido)}}"><button class="btn btn-info">Detalles</button></a>
							<a href="{{URL::action('PedidoController@edit', $ped->idpedido)}}"><button class="btn btn-info">Editar Estado</button></a>
							<a href="" data-target="#modal-delete-{{$ped->idpedido}}" data-toggle="modal"><button class="btn btn-danger">Finalizar</button></a>
						</td>
					</tr>
					@include('mecanico.pedido.modal')
					@endforeach
					
				</table>
				
			</div>
			{{$pedidos->render()}}
			
		</div>
	</div>
@endsection