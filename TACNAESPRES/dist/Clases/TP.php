<?php

class TP
    {        
		public function conectar_db($cn){
			$this->con = $cn;
		}

		public function sanitize($var) {
			$valor = mysqli_real_escape_string($this->con, $var);
			return $valor;
		}
		
		public function listaTP(){
			$sql = "SELECT * FROM condiciones";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

        public function busca($id){
			$sql = "SELECT * FROM condiciones where CODI='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}

		public function nueva_condicion($id,$desc,$nd,$tp,$act){
			$sql = "insert into condiciones(CODI,NOMB,NDIAS,TIPDOC,ACTI) values ('$id','$desc','$nd','$tp','$act')";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}	

		public function modifica_condicion($id,$desc,$nd,$tp,$act){
			$sql = "update condiciones set
			TIPDOC='$tp',
            NOMB='$desc',
            NDIAS='$nd',
            ACTI = '$act'
			where CODI='$id'";
			
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}

		}	
			
		public function borrar($id){
			$sql = "DELETE FROM condiciones WHERE CODI=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
    }