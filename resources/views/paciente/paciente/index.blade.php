@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de pacientes <a href="paciente/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('paciente.paciente.search')
		</div>
	</div>
	@if(Session::has('notice'))<!-- crea una alerta de q ha sido creado correctamente el usuario-->
                
   					<div class="alert alert-info">{{ Session::get('notice') }}</div>
				
    @endif
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>DNI</th>
						<th>Obra Social</th>
						<th>Sangre</th>
						<th>Telefono</th>
						<th>Email</th>
						<th>Condicion</th>
					</thead>
					<!-- bucle -->
					@foreach ($pacientes as $pac)
					<tr>
						<td>{{$pac->nombre}}</td>
						<td>{{$pac->apellido}}</td>
						<td>{{$pac->documento}}</td>
						<td>{{$pac->obrasocial}}</td>
						<th>{{$pac->tipo_sangre}}</th>
						<td>{{$pac->telefono}}</td>
						<td>{{$pac->email}}</td>
						<td>{{$pac->condicion}}</td>
						<td>
							<a href="{{URL::action('PacienteController@edit', $pac->idpaciente)}}"><button class="btn btn-info"> Editar</button></a>
							<a href="https://localhost/APPODONTOGRAMA/view/?idpaciente={{$pac->idpaciente}}&nombre={{$pac->nombre}}&apellido={{$pac->apellido}}"><button class="btn .btn.bg-maroon">Odontograma</button></a>
							<a href="" data-target="#modal-delete-{{$pac->idpaciente}}" data-toggle="modal"><button class="btn btn-danger"> Eliminar</button></a>
						</td>
					</tr>
					@include('paciente.paciente.modal')
					@endforeach
					
				</table>
				
			</div>
			{{$pacientes->render()}}
			
		</div>

	</div>
@endsection