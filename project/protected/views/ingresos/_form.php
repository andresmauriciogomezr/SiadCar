<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingresos-form',
	'action'=>($model->isNewRecord)?$this->createUrl('ingresos/create__ajax'):$this->createUrl('ingresos/update__ajax/'.$model->id),
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form '.(($model->isNewRecord)?'success__clear-form':''),
		'role'=>'form',
		'method'=>'post',
	),
)); ?>

<style type="text/css">
	canvas {
	  width: 100%;
	  height: auto;
	}
</style>



	<div class="row">
		<div class="col-xs-12">
			<div class="widget">
				<div class="widget__header">
					<h2>Datos Vehiculo</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6 col-xs-12">
							<div class="form__section">
								<label class="form__label">Placas:</label>
								<input type="text" name="Vehiculos[placas]" id="Vehiculos__placas" data-load__info="<?php echo $this->createUrl('vehiculos/get_info') ?>" class="form__input input__mask" required <?php echo (isset($vehiculo))?'readonly disabled':''; ?> value="<?php echo (isset($vehiculo))?$model->vehiculo0->placas:''; ?>" data-mask='aaa-999'>
								<?php echo $form->hiddenField($model,'vehiculo',array('required'=>true)); ?>
						  	</div>
							  	<div id="ingresos__go__add" style="<?php echo (isset($vehiculo))?'display:none;':''; ?>">
						  			<a class="btn" href="<?php echo $this->createUrl('vehiculos/create'); ?>">Agregar vehículo</a>
							  	</div>
						</div>
					</div>
					<div id="Vehiculos__info">
						<?php echo (isset($vehiculo))?$vehiculo:''; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="widget">
				<div class="widget__header">
					<h2>Ingreso Vehiculo</h2>
					<p id="id_ingreso" hidden><?php echo (isset($model)?$model->id:"");?></p>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Tipo:</label>
								<?php echo $form->dropDownList($model,'tipo', $tipos, array('class'=>'form__input','required'=>true)); ?>
						  	</div>
						</div>
						<div class="col-xs-12">
							<div class="form__section">
								<label class="form__label">Observaciones del cliente:</label>
								<?php echo $form->textArea($model,'observaciones_cliente',array('class'=>'ckeditor','placeholder'=>'Ninguna','rows'=>6, 'required'=>true)); ?>
						  	</div>
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
					<h2>Estado Vehiculo</h2>
				</div>
				<div class="widget__body padding">
					<div class="row">
						<div class="col-sm-6">
							<div class="form__section">
								<label class="form__label">Kilometraje:</label>
								<?php echo $form->textField($model,'kilmetraje',array('class'=>'form__input input__number','required'=>true)); ?>
						  	</div>
						</div>
					</div>


					<div class="row">

						<div class="col-xs-12">
							<div class="form__section">
								<label class="form__label">Desperfectos:</label>
								<?php echo $form->textArea($model,'desperfectos',array('class'=>'ckeditor','placeholder'=>'Ninguna','rows'=>6)); ?>
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








					<div class="row">
						<div class="col-xs-12">
							<label class="form__label">Elementos en el auto:</label>
							<div class="row">
								<?php
						  		$elementosModel = CJSON::decode($model->elementos);
								foreach ($elementos as $key => $elemento) { ?>
						  			<div class="col-sm-4 col-xs-12">
							  			<div class="form__section">
								  			<label><input
								  				type="checkbox"
								  				name="RegistrosIngreso[elementos][]"
								  				value="<?php echo $elemento->id; ?>"
								  				<?php echo (in_array($elemento->id,$elementosModel,false))?'checked="checked"':''; ?>> 
								  					<?php echo $elemento->nombre; ?>
								  			</label>
								  		</div>
						  			</div>
						  		<?php } ?>
							</div>
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
					<?php echo $form->textArea($model,'observaciones',array('class'=>'ckeditor','placeholder'=>'Ninguna','rows'=>6)); ?>
				</div>
			</div>
		</div>
		<br>
		<div class="col-xs-12">
			<div class="form__section">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar' : 'Guardar', array('class'=>'btn')); ?>
                <a href="<?php echo $this->createUrl('ingresos/admin'); ?>" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/jquery.min.js"></script>
<script type="text/javascript">
	//var c = document.getElementById("myCanvas");

	//var c = $("#myCanvas");//
	var dagnios = Array()

	
	$( document ).ready(function() {
	  dibujarCanvas();
	  pedirDagnios();
	});

	function pedirDagnios(){
		var id = $("#id_ingreso");
		var data = {id : id};
		if (id != "") {
			$.ajax({
		        url: '<?php $ruta = "ingresos/getDagnios?id=$model->id"; echo $this->createUrl($ruta)?>',
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

	$('#superior').on('click', function(e){
		event = e;
		event = event || window.event;
		var canvas = document.getElementById('superior');
	    var ctx = canvas.getContext("2d");

		var rect = canvas.getBoundingClientRect();
		x = (event.clientX - rect.left) / (rect.right - rect.left) * canvas.width;
		y = (event.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height;

		//console.log('x :' + x + ' y :' + y)
		descripcion = pedirDescripcion();
		dagnios.push({ubicacion : 'superior', x : x, y : y, descripcion : descripcion})
		$("#danos").append("<tr><td>" + dagnios.length +"</td><td>" + descripcion +"</td></tr>")

		ctx.font = "10px Arial";
		ctx.fillText(dagnios.length,x,y);

		//console.log(dagnios)
    });

    $('#izquierdo').on('click', function(e){
		event = e;
		event = event || window.event;
		var canvas = document.getElementById('izquierdo');
	    var ctx = canvas.getContext("2d");

		var rect = canvas.getBoundingClientRect();
		x = (event.clientX - rect.left) / (rect.right - rect.left) * canvas.width;
		y = (event.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height;

		//console.log('x :' + x + ' y :' + y)
		descripcion = pedirDescripcion();
		dagnios.push({ubicacion : 'izquierdo', x : x, y : y, descripcion : descripcion})
		$("#danos").append("<tr><td>" + dagnios.length +"</td><td>" + descripcion +"</td></tr>")

		ctx.font = "10px Arial";
		ctx.fillText(dagnios.length,x,y);
		//console.log(dagnios)

    });

    $('#derecho').on('click', function(e){
		event = e;
		event = event || window.event;
		var canvas = document.getElementById('derecho');
	    var ctx = canvas.getContext("2d");

		var rect = canvas.getBoundingClientRect();
		x = (event.clientX - rect.left) / (rect.right - rect.left) * canvas.width;
		y = (event.clientY - rect.top) / (rect.bottom - rect.top) * canvas.height;

		//console.log('x :' + x + ' y :' + y)
		descripcion = pedirDescripcion();
		dagnios.push({ubicacion : 'derecho', x : x, y : y, descripcion : descripcion})
		$("#danos").append("<tr><td>" + dagnios.length +"</td><td>" + descripcion +"</td></tr>")

		ctx.font = "10px Arial";
		ctx.fillText(dagnios.length,x,y);
		//console.log(dagnios)

    });

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



    function pedirDescripcion(){
    	var dagnio = prompt("Descripcion del dano");
	    if (dagnio == null || dagnio == "") {
	        return "Sin descripcion";
	    } else {
	        return dagnio;
	    }
    }

	

</script>