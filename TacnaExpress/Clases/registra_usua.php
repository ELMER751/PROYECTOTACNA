<?php
// Assuming you have already established a database connection and assigned it to the variable $con.
class Registro {
    private $idUsuario;
    private $contraseña;
    private $usuario;
    private $con;
    public function conectar_db($cn){
        $this->con = $cn;

    }

    public function sanitize($var) {
        $valor = mysqli_real_escape_string($this->con, $var);
        return $valor;
    }
    
    public function listaprodu(){
        $sql = "SELECT * FROM fuser";
        $res = mysqli_query($this->con, $sql);
        return $res;
    }
    public function busca($nomb){
        $sql = "SELECT * FROM fuser where USUARIO='$nomb'";
        $res = mysqli_query($this->con, $sql);
        $return = mysqli_fetch_array($res );
        return $return ;
    }
    public function consulta($id){
        $sql = "SELECT * FROM fuser where CODUSUARIO=$id";
        $res = mysqli_query($this->con, $sql);
        $return = mysqli_fetch_array($res);
        return $return ;
    }
    public function registrar_usuario($user, $pas, $nom, $nivel,$act,$ocu,$dni,$bre,$cede) {
        $sql = "INSERT INTO fuser (USUARIO,PASSWORD,NOMBRES,NIVEL,ACTI,OCUPACION,DNI,BREVETE,CEDE) values ('$user', '$pas', '$nom', '$nivel','$act','$ocu','$dni','$bre','$cede')";
        $res = mysqli_query($this->con, $sql);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }
    public function modi_usuario($id,$user,$pas,$nom,$nivel,$act,$ocu,$dni,$bre,$cede){
        $sql = "update fuser set
			NOMBRES = '$nom',
			PASSWORD = '$pas',
            NIVEL = '$nivel',
            ACTI= '$act',
            USUARIO = '$user',
            OCUPACION = '$ocu',
            DNI= '$dni',
            BREVETE = '$bre',
            CEDE = '$cede'
			where CODUSUARIO = '$id'";
			
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
    }
    public function borrar($id){
		$sql = "DELETE FROM fuser WHERE CODUSUARIO = $id";
		$res = mysqli_query($this->con, $sql);
		if($res){
			return true;
		}else{
			return false;
		}
	}

public function set_id($id){
    $this->idUsuario = $id;
}
public function set_usuario($nom){
    $this->usuario = $nom;
}
public function set_contraseña($pas){
    $this->contraseña = $pas;
}

public function get_idproducto(){
    return $this->idUsuario;
}
public function get_nomproducto(){
    return $this->usuario;
}
public function get_unimed(){
    return $this->contraseña;
}

}


?>