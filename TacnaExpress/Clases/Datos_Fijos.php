<?php

class Datos_Fijos 
    {        
		public function conectar_db($cn){
			$this->con = $cn;

		}

		public function sanitize($var) {
			$valor = mysqli_real_escape_string($this->con, $var);
			return $valor;
		}
		
		public function listaruta(){
			$sql = "SELECT * FROM datos_fijos";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

        public function busca($id){
			$sql = "SELECT * FROM datos_fijos where IDDATFI='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}

		public function buscar($buscar){
			$sql = "SELECT * FROM datos_fijos WHERE LIQUIDACION = '$buscar'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
		public function datos_fijos($fecha_transaccion, $liquidacion, $codigo_camion, $codigo_chofer, $codigo_copiloto, $codigo_liquidador, $fecha_partida, $hora_partida, $direccion_partida, $direccion_llegada_ilo, $direccion_llegada_moq, $direccion_llegada_tacna, $licencia, $cede) {
			$sql = "INSERT INTO datos_fijos (FEC_TRANS, LIQUIDACION, CODIGO_CAMION, CODIGO_CHOFER, CODIGO_COPILOTO, CODIGO_LIQUIDADOR, FECHA_PARTIDA, HORA_PARTIDA, DIRECCION_PARTIDA, DIRECCION_LLEGADA_ILO, DIRECCION_LLEGADA_MOQ, DIRECCION_LLEGADA_TACNA, LIC, CEDE) VALUES ('$fecha_transaccion', '$liquidacion', '$codigo_camion', '$codigo_chofer', '$codigo_copiloto', '$codigo_liquidador', '$fecha_partida', '$hora_partida', '$direccion_partida', '$direccion_llegada_ilo', '$direccion_llegada_moq', '$direccion_llegada_tacna', '$licencia', '$cede')";
			$res = mysqli_query($this->con, $sql);
			if ($res) {
				return true;
			} else {
				return false;
			}
		}
		public function modificar_datosfijos($fecha_transaccion, $liquidacion, $codigo_camion, $codigo_chofer, $codigo_copiloto, $codigo_liquidador, $fecha_partida, $hora_partida, $direccion_partida, $direccion_llegada_ilo, $direccion_llegada_moq, $direccion_llegada_tacna, $licencia, $cede) {
			$sql = "UPDATE datos_fijos SET 
			FEC_TRANS='$fecha_transaccion',  
			CODIGO_CAMION='$codigo_camion', 
			CODIGO_CHOFER='$codigo_chofer', 
			CODIGO_COPILOTO='$codigo_copiloto', 
			CODIGO_LIQUIDADOR='$codigo_liquidador', 
			FECHA_PARTIDA='$fecha_partida', 
			HORA_PARTIDA='$hora_partida',
			DIRECCION_PARTIDA='$direccion_partida', 
			DIRECCION_LLEGADA_ILO='$direccion_llegada_ilo', 
			DIRECCION_LLEGADA_MOQ='$direccion_llegada_moq', 
			DIRECCION_LLEGADA_TACNA='$direccion_llegada_tacna', 
			LIC='$licencia', 
			CEDE='$cede' 
			WHERE LIQUIDACION='$liquidacion'";
			$res = mysqli_query($this->con, $sql);
			if ($res) {
				return true;
			} else {
				return false;
			}
		}
		public function borrar($id){
			$sql = "DELETE FROM ruta WHERE CODIGO=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
    }