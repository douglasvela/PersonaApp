<html>
<head>
	<title></title>
</head>
<body>
<?php
$nr = $_POST['nr'];
	$conexion = mysqli_connect("162.241.252.245","proyedk4_WPZF0","MAYO_nesa94","proyedk4_WPZF0"); 
	$query_consulta_cumple=mysqli_query($conexion,"select UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_empleado,
			e.fecha_nacimiento, TIMESTAMPDIFF(YEAR,e.fecha_nacimiento,CURDATE()) AS edad from sir_empleado e where id_estado= 1 and DATE_FORMAT(e.fecha_nacimiento, '%m') = '".date("m")."' order by DATE_FORMAT(e.fecha_nacimiento, '%d')"); 
	$letras=mysqli_num_rows($query_consulta_cumple);
	while( $filacumple=mysqli_fetch_array($query_consulta_cumple)){
			$indicador_cumple[] = $filacumple;
			}
	foreach ($indicador_cumple as $fila_indicador_cumple) {}

	$mesesarray = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');


	$query_consulta_empleados=mysqli_query($conexion,"select SUM(CASE WHEN id_genero = '1' THEN 1 ELSE 0 END) masc,
							SUM(CASE WHEN id_genero = '2' THEN 1 ELSE 0 END) feme,
							COUNT(id_empleado) AS total from sir_empleado where id_estado=1"); 
	while( $filaemple=mysqli_fetch_array($query_consulta_empleados)){
			$indicador_emple[] = $filaemple;
			}
	foreach ($indicador_emple as $fila_indicador_emple) {}

	$query_consulta_docs=mysqli_query($conexion,"select UPPER(CONCAT_WS(' ', e.primer_nombre, e.segundo_nombre, e.tercer_nombre, e.primer_apellido, e.segundo_apellido, e.apellido_casada)) AS nombre_empleado,
			e.fecha_vencimiento_dui, e.fecha_vencimiento_licencia_armas, 
			(CASE WHEN fecha_vencimiento_dui = '0000-00-00' THEN '1' WHEN fecha_vencimiento_dui IS NULL THEN '1' WHEN e.fecha_vencimiento_dui <= '".date("Y-m-d")."' THEN '0' ELSE '2' END) dias_dui, 
			(CASE WHEN fecha_vencimiento_licencia_armas = '0000-00-00' THEN '1' WHEN fecha_vencimiento_licencia_armas IS NULL THEN '1' WHEN e.fecha_vencimiento_licencia_armas <= '".date("Y-m-d")."' THEN '0' ELSE '2' END) dias_licencia_arma from sir_empleado e where id_estado=1 and ((e.fecha_vencimiento_dui <> '0000-00-00' AND e.fecha_vencimiento_dui <= '".date("Y-m-d")."') OR (e.fecha_vencimiento_licencia_armas <> '0000-00-00' AND e.fecha_vencimiento_licencia_armas <= '".date("Y-m-d")."'))"); 
	$numdoc=mysqli_num_rows($query_consulta_docs);
	while( $filadocs=mysqli_fetch_array($query_consulta_docs)){
			$indicador_docs[] = $filadocs;
			}
	foreach ($indicador_docs as $fila_indicador_docs) {}
?>
<div class="container-fluid"> <br>
	<div class="row">       	
		<div class="col-lg-4">
                <div class="card card-inverse card-primary">
                    <div class="card-body" style="cursor: pointer;" onclick="" align="center">
                        <h1 class="text-white"><i class=""></i> &emsp;<small><?php echo $letras; if($letras==1) { echo " Persona"; }else{ echo " Personas"; } ?></small></h1>
                        <h3 class="card-title"><?php if($letras==1) { echo "Cumple "; }else{ echo "Cumplen "; } ?>años en <?=$mesesarray[date("m")-1]?><br></h3>
                    </div>
                </div>
            </div>
        <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 align="center">Personas empleadas</h4>
                        <div class="d-flex flex-row" align="center">
                            <div class="p-0 b-r" align="center" style="width: 50%;">
                                <h6 class="font-light">Hombres</h6><h6><?php echo $fila_indicador_emple[0]; ?></h6><h6><?php echo number_format($fila_indicador_emple[0]/$fila_indicador_emple[2]*100,2); ?>%</h6>
                            </div>
                            <div class="p-0" align="center" style="width: 50%;">
                                <h6 class="font-light">Mujeres</h6><h6><?php echo $fila_indicador_emple[1]; ?></h6><h6><?php echo number_format($fila_indicador_emple[1]/$fila_indicador_emple[2]*100,2); ?>%</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-lg-4">
                <div class="card card-inverse card-success">
                    <div class="card-body" style="cursor: pointer;" onclick="" align="center">
                        <h1 class="text-white"><i class=""></i> &emsp;<small><?php echo $numdoc; if($numdoc==1) { echo " Persona"; }else{ echo " Personas"; } ?></small></h1>
                        <h3 class="card-title"><?php if($numdoc==1) { echo "Tiene "; }else{ echo "Tienen "; } ?>documentos vencidos<br></h3>
                    </div>
                </div>
            </div>
	</div>
</div>
</body>
</html>