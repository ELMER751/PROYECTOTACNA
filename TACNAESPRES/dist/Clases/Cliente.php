<?php

class Cliente {
        
		private $id;
		private $nom;
		private $nruc;
        private $razon_social;
        private $telefono;
		private $fena;
		private $dire;
		private $dni;
		private $con;

		public function conectar_db($cn){
			$this->con = $cn;

		}

		public function sanitize($var) {
			$valor = mysqli_real_escape_string($this->con, $var);
			return $valor;
		}
		
		public function listaclintes(){
			$sql = "SELECT * FROM fmclinic";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

        public function busca($id){
			$sql = "SELECT * FROM fmclinic where CODC='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
		public function buscar_nruc($buscar){
			$sql = "SELECT * FROM fmclinic WHERE NRUC LIKE CONCAT('%', '$buscar', '%');";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
		public function busca_dni($buscar){
			$sql = "SELECT * FROM fmclinic WHERE DNI LIKE CONCAT('%', '$buscar', '%');";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
		public function buscar_nombre($buscar){
			$sql = "SELECT * FROM fmclinic WHERE NOMB LIKE CONCAT('%', '$buscar', '%') OR RAZON_SOCIAL LIKE CONCAT('%', '$buscar', '%');";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
		public function buscar_rz($buscar){
			$sql = "SELECT * FROM fmclinic WHERE RAZON_SOCIAL LIKE CONCAT('%', '$buscar', '%') OR RAZON_SOCIAL LIKE CONCAT('%', '$buscar', '%');";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
		public function nuevo_cliente($nomb,$razon_social,$fena,$nruc,$dni,$dire,$fono,$email,$c){
			if ($c === 0)
			{
				$sql = "insert into fmclinic(NOMB,FENA,DNI,DIRE) values ('$nomb','$fena','$dni','$dire')";	
			}
			else if ($c === 1)
			{
				$sql = "insert into fmclinic(RAZON_SOCIAL,FENA,NRUC,DIRE) values ('$razon_social','$fena','$nruc','$dire')";
			}
			else if ($c === 2)
			{	
				if($nruc === ""){
					$sql = "insert into fmclinic(NOMB,FENA,DNI,DIRE,FONO,EMAIL) values ('$nomb','$fena','$dni','$dire','$fono',',$email')";
				}
				else{
					$sql = "insert into fmclinic(NOMB,RAZON_SOCIAL,FENA,NRUC,DNI,DIRE,FONO,EMAIL) values ('$nomb','$razon_social','$fena','$nruc','$dni','$dire','$fono',',$email')";
				}
				
			}
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}

		}	
		public function modifica_cliente($id,$nomb,$razon_social,$fena,$nruc,$dni,$dire,$fono,$email){
			try{
			$sql = "update fmclinic set
			NOMB = '$nomb',
			RAZON_SOCIAL ='$razon_social',
			FENA = '$fena',
			NRUC = '$nruc',
			DNI = '$dni',
			DIRE = '$dire',
			FONO = '$fono',
			EMAIL = '$email'
			where CODC = '$id'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
			}
			catch (mysqli_sql_exception $e){
				echo "Error inesperado. Por favor, vuelve a intentarlo más tarde.";
			}
		}	
			
		public function borrar($id){
			$sql = "DELETE FROM fmclinic WHERE CODC=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
    }