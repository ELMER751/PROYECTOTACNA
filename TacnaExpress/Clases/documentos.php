<?php 
    Class Documentos {
        public function conectar_db($cn){
			$this->con = $cn;
		}

		public function sanitize($var) {
			$valor = mysqli_real_escape_string($this->con, $var);
			return $valor;
		}
		
		public function listaDoc(){
			$sql = "SELECT * FROM fcabecer";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

        public function listaDocEliminado(){
			$sql = "SELECT * FROM fdoceliminados";
			$res = mysqli_query($this->con, $sql);
			return $res;
		}

        public function busca($id){
			$sql = "SELECT * FROM fcabecer where DOC1='$id'";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
        public function buscar_docu($doc,$idemXY){
			$sql = "SELECT * FROM fcabecer where DOC1='$doc' AND IDEM='$idemXY' ";
			$res = mysqli_query($this->con, $sql);
			$return = mysqli_fetch_array($res );
			return $return ;
		}
        
		public function fcabecer($NumdocGenerado,$MESP, $idemXY, $serieXY, $txtruc, $totbruto, $Dscto, $vvtatot, $MonIGV, $totPrecVenta, $Date, $fecaten, $cliente, $ruc, $dir, $condi, $igv, $USR, $time, $fec, $dscto, $incremento, $tipc, $montoTipc, $guia, $numfacbol, $rucdniR, $nombR, $dirR, $rucdniC, $nombC, $dirC, $destino, $ODESORI, $placa, $lice, $conductor, $masigv, $CtaCorriente, $Observa, $sede) {
			$sql = "INSERT INTO FCABECER 
            (    MESP  ,    IDEM ,    IDEM2 ,    CODI,          DOC1,           MONB,       DSCT,       TOTV,       IGVE,      TOTL,        EMIT,ESTA,        FEC1,      FEC2,         NOMEMPRE,     RUCEMPRE,  DIREMPRE,    COND,       IGV,      USUARIO,    HORAREG,   FECREG,    DSCT_FAR,     NDIAS,          MONEDA,     TIP_CAMB,       DOCAUTORI,     NAUTORIZA,       RUCDNIRE,     NOMBRE,       DIRERE,   RUCDNICO,       NOMBCO,     DIRECO,      RUTADES,     ODESORI,        PLACA,         LIC,       CHOFCOND,      MASIGV,        IDCTE,              OBSERV,      SEDE)
            VALUES
            (   '$MESP', '$idemXY', '$serieXY', '$txtruc', '$NumdocGenerado', '$totbruto', '$Dscto', '$vvtatot', '$MonIGV', '$totPrecVenta', '1', 'EMITIDO', '$Date', '$fecaten',      '$cliente',     '$ruc',     '$dir', '$condi',   '$igv',     '$USR',     '$time',    '$fec',     '$dscto', '$incremento',    '$tipc',    '$montoTipc',   '$guia',     '$numfacbol',      '$rucdniR',     '$nombR',   '$dirR', '$rucdniC',     '$nombC',   '$dirC',    '$destino',   '$ODESORI',     '$placa',       '$lice',  '$conductor',  '$masigv',      '$CtaCorriente',    '$Observa', '$sede')";
			$res = mysqli_query($this->con, $sql);
			if ($res) {
				return true;
			} else {
				return false;
			}
		}

        public function fcabecernota($NumdocGenerado,$MESP, $idemXY, $serieXY, $txtruc, $totbruto, $Dscto, $vvtatot, $MonIGV, $totPrecVenta, $Date, $fecaten, $cliente, $ruc, $dir, $condi, $igv, $USR, $time, $fec, $dscto, $incremento, $tipc, $montoTipc, $guia, $numfacbol, $rucdniR, $nombR, $dirR, $rucdniC, $nombC, $dirC, $destino, $ODESORI, $placa, $lice, $conductor, $masigv, $CtaCorriente, $motivo, $sede, $doc2, $codv, $fec2) {
			$sql = "INSERT INTO FCABECER 
            (    MESP  ,    IDEM ,    IDEM2 ,    CODI,          DOC1,           MONB,       DSCT,       TOTV,       IGVE,      TOTL,        EMIT,ESTA,        FEC1,      FEC2,         NOMEMPRE,     RUCEMPRE,  DIREMPRE,    COND,       IGV,      USUARIO,    HORAREG,   FECREG,    DSCT_FAR,     NDIAS,          MONEDA,     TIP_CAMB,       DOCAUTORI,     NAUTORIZA,       RUCDNIRE,     NOMBRE,       DIRERE,   RUCDNICO,       NOMBCO,     DIRECO,      RUTADES,     ODESORI,        PLACA,         LIC,       CHOFCOND,      MASIGV,        IDCTE,              MOTIVO,      SEDE,   DOC2,    CODV)
            VALUES
            (   '$MESP', '$idemXY', '$serieXY', '$txtruc', '$NumdocGenerado', '$totbruto', '$Dscto', '$vvtatot', '$MonIGV', '$totPrecVenta', '1', 'EMITIDO', '$Date',   '$fec2',      '$cliente',     '$ruc',     '$dir', '$condi',   '$igv',     '$USR',     '$time',    '$fec',     '$dscto', '$incremento',    '$tipc',    '$montoTipc',   '$guia',     '$numfacbol',      '$rucdniR',     '$nombR',   '$dirR', '$rucdniC',     '$nombC',   '$dirC',    '$destino',   '$ODESORI',     '$placa',       '$lice',  '$conductor',  '$masigv',      '$CtaCorriente',    '$motivo', '$sede', '$doc2','$codv')";
			$res = mysqli_query($this->con, $sql);
			if ($res) {
				return true;
			} else {
				return false;
			}
		}

		public function modificar_fcabecer($MESP, $idemXY, $serieXY, $txtruc, $NumdocGenerado, $totbruto, $Dscto, $vvtatot, $MonIGV, $totPrecVenta, $Date, $fecaten, $cliente, $ruc, $dir, $condi, $igv, $USR, $time, $fec, $dscto, $incremento, $tipc, $montoTipc, $guia, $numfacbol, $rucdniR, $nombR, $dirR, $rucdniC, $nombC, $dirC, $destino, $ODESORI, $placa, $lice, $conductor, $masigv, $CtaCorriente, $Observa, $sede) {
			$sql = "UPDATE FCABECER SET 
            MESP='$MESP', 
            IDEM='$idemXY', 
            IDEM2='$serieXY', 
            CODI='$txtruc', 
            DOC1='$NumdocGenerado', 
            MONB='$totbruto', 
            DSCT='$Dscto', 
            TOTV='$vvtatot', 
            IGVE='$MonIGV', 
            TOTL='$totPrecVenta', 
            EMIT='1', 
            ESTA='', 
            FEC1='$Date', 
            FEC2='$fecaten', 
            NOMEMPRE='$cliente', 
            RUCEMPRE='$ruc', 
            DIREMPRE='$dir', 
            COND='$condi', 
            IGV='$igv', 
            USUARIO='$USR', 
            HORAREG='$time', 
            FECREG='$fec', 
            DSCT_FAR='$dscto', 
            NDIAS='$incremento', 
            MONEDA='$tipc', 
            TIP_CAMB='$montoTipc', 
            DOCAUTORI='$guia', 
            NAUTORIZA='$numfacbol', 
            RUCDNIRE='$rucdniR', 
            NOMBRE='$nombR', 
            DIRERE='$dirR', 
            RUCDNICO='$rucdniC', 
            NOMBCO='$nombC', 
            DIRECO='$dirC', 
            RUTADES='$destino', 
            ODESORI='$ODESORI', 
            PLACA='$placa', 
            LIC='$lice', 
            CHOFCOND='$conductor', 
            MASIGV='$masigv', 
            IDCTE='$CtaCorriente', 
            OBSERV='$Observa', 
            SEDE='$sede'
            WHERE DOC1='$NumdocGenerado'";
			$res = mysqli_query($this->con, $sql);
			if ($res) {
				return true;
			} else {
				return false;
			}
		}
		public function borrar($id){
			$sql = "DELETE FROM fcabecer WHERE DOC1=$id";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
    }

?>