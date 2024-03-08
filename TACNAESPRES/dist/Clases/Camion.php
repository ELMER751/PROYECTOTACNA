<?php

class Camion {
        
		private $id;
		private $placa;
		private $marca;
		private $certificado;
		private $con_vehicular;
		private $carga;
		private $con;

		public function conectar_db($cn){
			$this->con = $cn;

		}

		public function sanitize($var) {
			$valor = mysqli_real_escape_string($this->con, $var);
			return $valor;
		}
		
		public function listacamion(){
			$sql = "SELECT * FROM camiones";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

        public function busca($id){
			$sql = "SELECT * FROM camiones where CODIGO=$id";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
		public function buscar($buscar){
			$sql = "SELECT * FROM camiones WHERE MARCA LIKE CONCAT('%', '$buscar', '%');";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
		public function nuevo_camion($ID,$PLACA,$MARCA,$CER,$CON,$CAR){
			$sql = "insert into camiones(CODIGO,PLACA,MARCA,CERTIFICADO,CONFIGURACION_VEHICULAR,CARGA_MAXIMA) values ('$ID','$PLACA','$MARCA','$CER','$CON',$CAR)";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}

		}	
		public function modifica_camion($ID,$PLACA,$MARCA,$CER,$CON,$CAR){
			$sql = "update camiones set
			PLACA='$PLACA',
			MARCA='$MARCA',
			CERTIFICADO='$CER', 
			CONFIGURACION_VEHICULAR='$CON',
			CARGA_MAXIMA=$CAR 
			where CODIGO='$ID'";
			
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}

		}	
			
		public function borrar($id){
			$sql = "DELETE FROM camiones WHERE CODIGO=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
		
		public function set_idcodigo($id){
			$this->id = $id;
		}
		public function set_placa($PLACA){
			$this->placa = $PLACA;
		}
		public function set_certificado($CER){
			$this->certificado = $CER;
		}
		public function set_config($CON){
			$this->con_vehicular = $CON;
		}
		public function set_carga($CAR){
			$this->carga = $CAR;
		}

		public function get_idcodigo(){
			return $this->id;
		}
		public function get_placa(){
			return $this->placa;
		}
		public function get_certificado(){
			return $this->certificado;
		}
		public function get_config(){
			return $this->con_vehicular;
		}
		public function get_carga(){
			return $this->carga;
		}
	}
?>