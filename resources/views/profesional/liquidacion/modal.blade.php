<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete">
	{{Form::Open(array('action'=>array('PreliquidacionController@destroy',$pro->idprofesional),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Consumir Todos los Productos</h4>
				</div>

				
					<div class="modal-body">
						<h3>Confirme Consumir Todos los Productos</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary">Confirmar</button>
					</div>

		</div>
	</div>
	{{Form::Close()}}
</div>