<?php
$funcion = $_POST['funcion'];
$id_empleado = $_POST['nr']; 
switch($funcion) {
        case 'reporte': 
            echo reporte_info_empleado($id_empleado);
            break;
    }
	

function reporte_info_empleado($id_empleado){

      $conexion = mysqli_connect("162.241.252.245","proyedk4_WPZF0","MAYO_nesa94","proyedk4_WPZF0"); 
      
     $cabecera_vista = '<table style="font-size: 14;" class="table"><tr> 
		<td width="950px"><h6><center>MINISTERIO DE TRABAJO Y PREVISION SOCIAL <br> DEPARTAMENTO DE RECURSOS HUMANOS <br>  INFORMACIÓN PERSONAL</center><h6></td>
	 	</tr></table>';
	 	$fecha=strftime( "%d-%m-%Y - %H:%M:%S", time() );
	 	//$pie = 'Usuario: '.$this->session->userdata('usuario_viatico').'    Fecha y Hora Creacion: '.$fecha.'||{PAGENO} de {nbpg} páginas';

	 	//$data = array('nr'=>'2588');
		//$empleado_NR_viatico = $this->Reportes_viaticos_model->obtenerNREmpleadoViatico($data);
		$query_consulta_nr=mysqli_query($conexion,"select * from org_usuario where nr='".$id_empleado."'");
      	while( $fila_nombre=mysqli_fetch_array($query_consulta_nr)){
            $empleado_nombre[] = $fila_nombre;
         }
		foreach ($empleado_nombre as $key_nombre) {	}
		
		//$ids = array('nr' => '2588');
		//$viatico = $this->Reportes_viaticos_model->obtenerListaviatico_pendiente($ids);
		$query_consulta=mysqli_query($conexion,"SELECT * FROM sir_empleado WHERE nr='".$id_empleado."'");
		while( $fila=mysqli_fetch_array($query_consulta)){
            $info[] = $fila;
         }
          
         if($info){ 
				foreach ($info as $informacion) {
		$cuerpo = '
		<h6 style="font-size: 12;">&nbsp;&nbsp;Empleado: '.($key_nombre[1]).'</h6>
		<div class="table-responsive">
			<table  class="table" style="font-size: 14;">
				<thead >
					<tr>
						<th >Primer Nombre</th>
						<th >Segundo Nombre</th>					 
					</tr>
					
				</thead>
				<tbody>
					
					';

					$cuerpo .= '
						<tr>
							<td>'.$informacion[1].'</td>
							<td>'.$informacion[2].'</td>
						</tr>
						';
				$cuerpo .='
					<div class="table-responsive">
					<table  class="table" style="font-size: 14;">
						<thead >
							<tr>
								<th >Primer Apellido</th>
								<th >Segundo Apellido</th>
							</tr>
						</thead>
						<tbody>
				';
				$cuerpo .= '
						<tr>
							<td>'.$informacion[4].'</td>
							<td>'.$informacion[5].'</td>
						</tr>
						';
					}
				}else{
				$cuerpo .= '
						<tr><td colspan="10"><center>No hay registros "'.$id_empleado.'"</center></td></tr>
					';
				}
				$cuerpo .= '
				</tbody>
			</table>
			</div>
        ';  

         mysqli_close($conexion);
      echo $cabecera_vista.=$cuerpo;
     
}
?>