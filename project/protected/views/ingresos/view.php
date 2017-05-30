<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Datos Propietario</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-4">
						<strong>Nombre y apellidos:</strong>
						<p><?php echo $propietario->usuario0->nombres; ?> <?php echo $propietario->usuario0->apellidos; ?></p>
					</div>
					<div class="col-sm-4">
						<strong>Identificacion:</strong>
						<p>CC: <?php echo $propietario->usuario0->cedula; ?></p>
					</div>
					<div class="col-sm-4">
						<strong>Correo electrónico:</strong>
						<p><?php echo $propietario->usuario0->email; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<strong>Ciduad:</strong>
						<p><?php echo $propietario->ciudad0->nombre; ?> - <?php echo $propietario->ciudad0->depende0->nombre; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Direcion:</strong>
						<p><?php echo $propietario->direccion; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Telefono:</strong>
						<p><?php echo $propietario->usuario0->telefono; ?></p>
					</div>
					<div class="col-sm-3">
						<strong>Celular:</strong>
						<p><?php echo $propietario->celular; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Ingreso del Vehiculo</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-6">
						<strong>Tipo de mantenimiento:</strong>
						<p><?php echo $ingreso->tipo0->nombre; ?></p>
					</div>
					<div class="col-sm-6">
						<?php $fechaIngreso = new DateTime($ingreso->fecha); ?>
						<strong>Fecha de ingreso:</strong>
						<p><?php echo $fechaIngreso->format('d \d\e F Y H:i:s'); ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<strong>Observaciones del cliente:</strong>
						<p><?php echo $ingreso->observaciones_cliente; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Estado del Vehiculo</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-sm-12">
						<strong>Kilometraje:</strong>
						<p><?php echo $ingreso->kilmetraje; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<strong>Desperfetos:</strong>
						<p><?php echo $ingreso->desperfectos; ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<strong>Elementos en el auto:</strong>
						<p>
							<?php $elementos = CJSON::decode($ingreso->elementos); ?>
							<ul class="row">
								<?php
									foreach ($elementos as $key => $elemento) {
										$elemento = ElementosVehiculo::model()->findByPk($elemento);
									?>
										<li class="col-sm-4 col-xs-12"><?php echo $elemento->nombre; ?></li>
									<?php }
								?>
							</ul>
							<?php echo (count($elementos) == 0)?'Ninguno':''; ?>
						</p>
					</div>
				</div>
			</div>




					<div>
			  			<!--<a class="btn" href="<?php echo $this->createUrl('vehiculos/create'); ?>">Severo</a>-->
			  			<a class="btn" onclick="botonDagnios()">Ver daños del vehículo</a>
				  	</div>
				  	<!-- contendrá los daños del vehículo-->
					<input id="dagnios" name="dagnios" hidden>

						
					<div id="panelDagnios" hidden>
						<div class="widget__header">
							<h2>Daños del vehículo</h2>
						</div>

						<div class="row">
							<div class="col-xs-8">
								<canvas id="superior" style="border:1px solid #000000;">
								</canvas>
							</div>
							<div class="col-xs-4">
								<div class="table-responsive">
								  <table id="danos" class="table table-striped table-bordered">
								  	<thead>
									    <tr>								    
									    	<td><strong>N° Daño</strong></td>
									    	<td><strong>Descipción</strong></td>								    	
									    </tr>
									</thead>

								  </table>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-6">
								<canvas id="izquierdo" style="border:1px solid #000000;">
								</canvas>
							</div>
							<div class="col-xs-6">
								<canvas id="derecho" style="border:1px solid #000000;">
								</canvas>
							</div>
						</div>

					</div>
					<br>





		</div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Registro Mantenimiento</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-xs-12">
						<?php if(count($mantenimientos) > 0){ ?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>No.</th>
										<th>Tipo</th>
										<th>Mecanico</th>
										<th>Cambios</th>
										<th>Fecha</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($mantenimientos as $key => $mantenimiento) {
										$fecha = new DateTime($mantenimiento->fecha);
									?>
										<tr>
											<td><?php echo $key+1; ?></td>
											<td><?php echo $mantenimiento->tipo0->nombre; ?></td>
											<td><?php echo $mantenimiento->mecanico0->nombres; ?> <?php echo $mantenimiento->mecanico0->apellidos; ?></td>
											<td><?php echo $mantenimiento->cambios; ?></td>
											<td><?php echo $fecha->format('d \d\e F Y H:i:s'); ?></td>
											<td>
												<div class="btn-group btn-group-xs">
					        						<a href="<?php echo $this->createUrl('ingresos/mantenimientos_view/'.$mantenimiento->id) ?>" data-toggle="tooltip" title="Ver" class="btn btn-primary"><i class="fa fa-external-link"></i></a>
					        					</div>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						<?php }
						else { ?>
							<p><strong>Ningun mantenimiento realizado.</strong></p>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget">
			<div class="widget__header">
				<h2>Observaciones</h2>
			</div>
			<div class="widget__body padding">
				<div class="row">
					<div class="col-xs-12">
						<p><?php echo $ingreso->observaciones; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if(Tools::hasPermission(4)){ ?>
	<div class="row end-xs">
		<div class="col-xs-12">
			<a href="<?php echo $this->createUrl('ingresos/print/'.$ingreso->id) ?>" class="btn">
				<i class="fa fa-print" aria-hidden="true"></i>
				Comprobante
			</a>
		</div>
	</div>
<?php } ?> 

<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery.min.js"></script>
<script type="text/javascript">
	
	$( document ).ready(function() {
	  dibujarCanvas();
	  pedirDagnios();
	});

	function pedirDagnios(){
		var id = $("#id_ingreso");
		var data = {id : id};
		if (id != "") {
			$.ajax({
		        url: '<?php $ruta = "ingresos/getDagnios?id=$ingreso->id"; echo $this->createUrl($ruta)?>',
		        type: 'POST',
		        dataType: 'json',
		        //data: 'data',
		    })
		    .done(function(data){
		    	for (var i = data.length - 1; i >= 0; i--) {
		    		$("#danos").append('<tr>'+								    
									    	'<td>'+ (i+1)+'</td>'+
									    	'<td>'+data[i].description+'</td>'+
									    '</tr>');
		    		dibujarDagnioSuperior(data[i], (i+1));
		    	}
		    	$.showNotify('Succes', 'severo', 'success');
		    })
		    .fail(function(data) {
		    	//console.log(data);
		        $.showNotify('Error', 'Paila', 'error');
		    })
		    .always(function() {
		        $.hiddenLoading();
		    });
		}
	}

	function dibujarDagnioSuperior(dagnio, index){
		var canvas = document.getElementById(dagnio.ubication);
	    var ctx = canvas.getContext("2d");

		var rect = canvas.getBoundingClientRect();
		x = dagnio.x
		y = dagnio.y

		ctx.font = "10px Arial";
		ctx.fillText(index,x,y);
		console.log("sisas");
	}


	function dibujarCanvas(){
		dibujarSuperior();
		dibujarIzquierdo();
		dibujarDerecho();
	}

	function botonDagnios(){
    		$('#panelDagnios').toggle();
    }


	function dibujarSuperior(){

		var canvas = document.getElementById('superior');

	    var imageObj = new Image();
	    imageObj.onload = function() {
	      ctx.drawImage(this, 0, 0, canvas.width, canvas.height);
	    };

	    var ctx = canvas.getContext("2d");
		ctx.font = "30px Arial";

	    //imageObj.src = "carro.png";
	    imageObj.src = "<?php print Yii::app()->request->baseUrl;?>/images/dagnios/superior.JPG";
	}

	function dibujarIzquierdo(){

		var canvas = document.getElementById('izquierdo');

	    var imageObj = new Image();
	    imageObj.onload = function() {
	      ctx.drawImage(this, 0, 0, canvas.width, canvas.height);
	    };

	    var ctx = canvas.getContext("2d");
		ctx.font = "30px Arial";

	    //imageObj.src = "carro.png";
	    imageObj.src = "<?php print Yii::app()->request->baseUrl;?>/images/dagnios/lateral.JPG";
	    
	}

	function dibujarDerecho(){

		var canvas = document.getElementById('derecho');

	    var imageObj = new Image();
	    imageObj.onload = function() {
	      ctx.drawImage(this, 0, 0, canvas.width, canvas.height);
	    };

	    var ctx = canvas.getContext("2d");
		ctx.font = "30px Arial";

	    //imageObj.src = "carro.png";
	    imageObj.src = "<?php print Yii::app()->request->baseUrl;?>/images/dagnios/lateral2.JPG";
	}	


</script>