<html>
<head>
	<title></title>
</head>
<body>
<?php
$nr = $_POST['nr'];
	$conexion = mysqli_connect("162.241.252.245","proyedk4_WPZF0","MAYO_nesa94","proyedk4_WPZF0"); 
	$query_consulta_revision=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_mision_oficial WHERE nr_empleado = '".$nr."' AND estado IN(1,3,5)"); 
	while( $filar=mysqli_fetch_array($query_consulta_revision)){
			$indicador_revision[] = $filar;
			}
	foreach ($indicador_revision as $fila_indicador_revision) {}

	$query_consulta_observacion=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_mision_oficial WHERE nr_empleado = '".$nr."' AND estado IN(2,4,6)"); 
	while( $filao=mysqli_fetch_array($query_consulta_observacion)){
			$indicador_observacion[] = $filao;
			}
	foreach ($indicador_observacion as $fila_indicador_observacion) {}

	$query_consulta_pagada=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_mision_oficial WHERE nr_empleado = '".$nr."' AND estado = 8"); 
	while( $filap=mysqli_fetch_array($query_consulta_pagada)){
			$indicador_pagada[] = $filap;
			}
	foreach ($indicador_pagada as $fila_pagada) {}

	$query_pasaje_revision=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_mision_pasajes WHERE nr = '".$nr."' AND estado IN(1,3,5)"); 
	while( $filapr=mysqli_fetch_array($query_pasaje_revision)){
			$indicador_pasaje_revision[] = $filapr;
			}
	foreach ($indicador_pasaje_revision as $fila_pasaje_revision) {}

	$query_pasaje_observados=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_mision_pasajes WHERE nr = '".$nr."' AND estado IN(2,4,6)"); 
	while( $filapo=mysqli_fetch_array($query_pasaje_observados)){
			$indicador_pasaje_observado[] = $filapo;
			}
	foreach ($indicador_pasaje_observado as $fila_pasaje_observado) {}

	$query_pasaje_pagado=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_mision_pasajes WHERE nr = '".$nr."' AND estado = 8"); 
	while( $filapp=mysqli_fetch_array($query_pasaje_pagado)){
			$indicador_pasaje_pagado[] = $filapp;
			}
	foreach ($indicador_pasaje_pagado as $fila_pasaje_pagado) {}

	$query_permiso_autorizar=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_informacion_empleado WHERE nr_jefe_inmediato = '".$nr."' OR nr_jefe_departamento = '".$nr."'"); 
	while( $filapermiso=mysqli_fetch_array($query_permiso_autorizar)){
			$indicador_permiso[] = $filapermiso;
			}
	foreach ($indicador_permiso as $fila_permisos_autorizar) {}

	$query_pasaje_autorizar=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_mision_pasajes WHERE (nr_jefe_inmediato = '".$nr."' AND estado = 1) OR (nr_jefe_regional = '".$nr."' AND estado = 3)"); 
	while( $filapa=mysqli_fetch_array($query_pasaje_autorizar)){
			$indicador_pa[] = $filapa;
			}
	foreach ($indicador_pa as $fila_indicador_pa) {}

	$query_viatico_autorizar=mysqli_query($conexion,"SELECT count(*) AS cantidad FROM vyp_mision_oficial WHERE (nr_jefe_inmediato = '".$nr."' AND estado = 1) OR (nr_jefe_regional = '".$nr."' AND estado = 3)"); 
	while( $filapv=mysqli_fetch_array($query_viatico_autorizar)){
			$indicador_pv[] = $filapv;
			}
	foreach ($indicador_pv as $fila_indicador_pv) {}
?>
<div class="container-fluid">
	<div class="row page-titles">
           <div class="align-self-center" align="center">
               <h3 class="text-themecolor m-b-0 m-t-0">Indicadores de solicitud de viáticos</h3>
           </div>
       	</div>
	<div class="row">       	
		<?php if($fila_permisos_autorizar>0){ ?>
	        <!-- Column -->
	        <div class="col-md-6 col-lg-3 col-xlg-3" >
	            <div class="card card-inverse card-dark">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $fila_indicador_pv[0]; ?></h1>
	                    <h5 class="text-white">Solicitudes para autorizar</h5>
	                </div>
	            </div>
	        </div>
	        <!-- Column -->
	    	<?php } ?>
		<div class="col-md-6 col-lg-3 col-xlg-3">
		    <div class="card card-inverse card-info" >
		        <div class="box bg-info text-center">
		            <h1 class="font-light text-white"><?php echo $fila_indicador_revision[0];?></h1>
		            <h5 class="text-white">Solicitudes en revisión</h5>
		        </div>
		    </div>
		</div>
		<div class="col-md-6 col-lg-3 col-xlg-3">
	            <div class="card card-primary card-inverse">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $fila_indicador_observacion[0]; ?></h1>
	                    <h5 class="text-white">Solicitudes observadas</h5>
	                </div>
	            </div>
	    </div>
	    <div class="col-md-6 col-lg-3 col-xlg-3" >
	            <div class="card card-inverse card-success">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $fila_pagada[0]; ?></h1>
	                    <h5 class="text-white">Solicitudes pagadas</h5>
	                </div>
	            </div>
	     </div>
	</div>
	<div class="row page-titles">
           <div class="align-self-center" align="center">
               <h3 class="text-themecolor m-b-0 m-t-0">Indicadores de solicitud de pasajes</h3>
           </div>
    </div>
    <div class="row">
    	<?php if($fila_permisos_autorizar>0){?>
    	<div class="col-md-6 col-lg-3 col-xlg-3" >
	            <div class="card card-inverse card-dark">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $fila_indicador_pa[0]; ?></h1>
	                    <h5 class="text-white">Solicitudes para autorizar</h5>
	                </div>
	            </div>
	        </div>
	      <?php }?>
    	 <div class="col-md-6 col-lg-3 col-xlg-3">
	            <div class="card card-inverse card-info">
	                <div class="box bg-info text-center">
	                    <h1 class="font-light text-white"><?php echo $fila_pasaje_revision[0]; ?></h1>
	                    <h5 class="text-white">Solicitudes en revisión</h5>
	                </div>
	            </div>
	    </div>
		<div class="col-md-6 col-lg-3 col-xlg-3"  >
	            <div class="card card-primary card-inverse">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $fila_pasaje_observado[0]; ?></h1>
	                    <h5 class="text-white">Solicitudes observadas</h5>
	                </div>
	            </div>
	    </div>
	    <div class="col-md-6 col-lg-3 col-xlg-3" >
	            <div class="card card-inverse card-success">
	                <div class="box text-center">
	                    <h1 class="font-light text-white"><?php echo $fila_pasaje_pagado[0]; ?></h1>
	                    <h5 class="text-white">Solicitudes pagadas</h5>
	                </div>
	            </div>
	        </div>
    </div>
</div>
</body>
</html>