@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>NUEVO TURNO</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
	{!! Form::open(array('url'=>'turno/turno', 'method'=>'POST', 'autocomplete'=>'off', 'files'=>'true'))!!}
	{{Form::token()}}

		@if(Session::has('notice'))<!-- crea una alerta de q ha sido creado correctamente el usuario-->
                
   					<div class="alert alert-info">{{ Session::get('notice') }}</div>
				
        @endif

		<div class="row">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group ">
				<label clas=>Paciente</label>
				<select name="idpaciente" id="idpaciente" class="form-control selectpicker" data-live-search="true">
					<option>Seleccione Paciente</option>
					@foreach($personas as $per)
						<option value="{{$per->idpersona}}_{{$per->idpaciente}}">{{$per->nombre . " " . $per->apellido}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
			<div class="form-group">
				<label>Prestacion/Profesional</label>
				<select name="idprestacion" id="idprestacion" class="form-control selectpicker" data-live-search="true">
					<option>Seleccione</option>
					@foreach($prestaciones as $pre)
					<option value="{{$pre->idprestacion}}_{{$pre->tiempo}}_{{$pre->costo}}_{{$pre->idprofesional}}_{{$pre->numero}}">{{$pre->nombre . " " . $pre->profesional . " " . $pre->apellido}}</option>
					@endforeach
				</select>
			</div>
		</div>
		
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="fecha">Fecha</label>
				<input type="date" id="fecha" name="fecha" class="form-control" data-date-format="mm/dd/yyyy" min="{{$fechamax}}">
			</div>
		</div>

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="fecha">Hora Inicio</label>
				<select name="hora_inicio" id="hora_inicio" class="form-control selectpicker" data-live-search="true">
					<option>Seleccione Hora Inicio</option>
					@foreach($horarios as $hor)
						<option value="{{$hor->hora}}">{{$hor->hora}}</option>
					@endforeach
					
				
				</select>
			</div>
		</div>

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label name="hora_fin" for="hora_fin">Hora Fin</label>
				<input type="text" name="hora_fin" id="hora_fin" class="form-control" placeholder="Hora Fin">
			</div>
		</div>

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
			<div class="form-group">
				<label for="ptiempo">Tiempo</label>
				<input type="time" name="ptiempo" id="ptiempo" value="{{old('ptiempo')}}" class="form-control" placeholder="Tiempo">
			</div>
		</div>

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="costo">Costo($)</label>
						<input type="double" name="costo" id="costo" value="{{old('costo')}}" disabled class="form-control" placeholder="ARS">
					</div>
		</div>

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
					<div class="form-group">
						<label for="Consultorio">Consultorio</label>
						<input type="num" name="consultorio" id="consultorio" readonly class="form-control" placeholder="Consultorio">
					</div>
		</div>
		
		<input type="num" name="profesional" id="profesional" style="visibility: hidden;" readonly class="form-control" placeholder="Consultorio">
		<input type="num" name="paciente" id="paciente" style="visibility: hidden;" readonly class="form-control" placeholder="Consultorio">
		

		
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group">
				<label for="observaciones">Observaciones</label>
				<textarea name="observaciones" required value="{{old('observaciones')}}" class="form-control" rows="5" cols="10" placeholder="Observaciones" required> </textarea>
			</div>
		</div>
		

		
		<div class="col-md-6 col-md-offset-3">
			<div class="col-md-6 col-md-offset-3">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>
		</div>


	</div>
	{!!Form::close() !!}

	@push ('scripts') 
	<!-- Trabajar con el script definido en el layout-->
	

	
	<script>

$(function() {
$('.').datepicker({
    startDate: '-3d'});
}
</script>

	<script>



		$(document).ready(function(){
			$('#bt_add').click(function(){
				agregar();
			});
		});
		$('#hora_inicio').change(mostrarValores);
		
		function mostrarValores(){
			datosPrestacion = document.getElementById('idprestacion').value.split('_');
			datosProfesional = document.getElementById('idprestacion').value.split('_');
			datosPaciente = document.getElementById('idpaciente').value.split('_');
			$('#ptiempo').val(datosPrestacion[1]);
			$('#costo').val("$ " +datosPrestacion[2]);
			$('#consultorio').val(datosProfesional[4]);
			$('#profesional').val(datosProfesional[3]);
			$('#paciente').val(datosPaciente[1]);

			inicio = document.getElementById("hora_inicio").value;
			fin = document.getElementById("ptiempo").value;
			  
			  inicioMinutos = parseInt(inicio.substr(3,2));
			  inicioHoras = parseInt(inicio.substr(0,2));
			  
			  finMinutos = parseInt(fin.substr(3,2));
			  finHoras = parseInt(fin.substr(0,2));

			  transcurridoMinutos = finMinutos + inicioMinutos;
			  transcurridoHoras = finHoras + inicioHoras;
			  
			  if (transcurridoMinutos > 59) {
			    transcurridoHoras++;
			    transcurridoMinutos = transcurridoMinutos - 60 ;
			  }
			  
			  horas = transcurridoHoras.toString();
			  minutos = transcurridoMinutos.toString();
			  
			  if (horas.length < 2) {
			    horas = "0"+horas;
			  }
			  
			  if (minutos.length < 2) {
			    minutos = "0"+minutos;
			  }

			  document.getElementById("hora_fin").value = horas+":"+minutos;
		}
	</script>

	<script type="text/javascript">
	function CheckTime(str) 
			{ 
			hora=str.value; 
			if (hora=='') { 
			return; 
			} 
			if (hora.length>8) { 
			alert("Introdujo una cadena mayor a 8 caracteres"); 
			return; 
			} 
			if (hora.length!=5) { 
			alert("Introducir HH:MM"); 
			return; 
			} 
			a=hora.charAt(0); //<=2 
			b=hora.charAt(1); //<4 
			c=hora.charAt(2); //: 
			d=hora.charAt(3); //<=5 
			e=hora.charAt(5); //: 
			f=hora.charAt(6); //<=5 
			if ((a==2 && b>3) || (a>2)) { 
			alert("El valor que introdujo en la Hora no corresponde, introduzca un digito entre 00 y 23"); 
			return; 
			} 
			if (d>5) { 
			alert("El valor que introdujo en los minutos no corresponde, introduzca un digito entre 00 y 59"); 
			return; 
			} 
			if (f>5) { 
			alert("El valor que introdujo en los segundos no corresponde"); 
			return; 
			} 
			if (c!=':') { 
			alert("Introduzca el caracter ':' para separar la hora, los minutos y los segundos"); 
			return; 
			} 
			} 

</script> 

	@endpush
@endsection