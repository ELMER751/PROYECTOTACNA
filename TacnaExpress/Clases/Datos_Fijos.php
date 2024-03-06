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
		}/// MODIFICAR 
		public function nueva_ruta($id,$destino,$abre,$dire){
			$sql = "insert into ruta(CODIGO,DESTINO,ABREVIATURA,DIRECCION) values ('$id','$destino','$abre','$dire')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}

		}	
		public function modifica_ruta($id,$destino,$abre,$dire){
			$sql = "update ruta set
			DESTINO='$destino',
            ABREVIATURA='$abre',
            DIRECCION='$dire'
			where CODIGO='$id'";
			
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
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