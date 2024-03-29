<?php
session_start();
    if (!isset($_SESSION["username"])) {
        header("Location: ingresar_sesion.php");
        exit();
        }
    if(isset($_POST['guardar'])){
            header("location: camiones_nuevo.php");
        }
    else if (isset($_POST['js'])){
        header("location: consume.php");
    }

    else if (isset($_POST['buscar']))
    {
        $tabla = "camiones";
        header("location: camiones_busca.php?tabla=$tabla");
    }

    else if(isset($_POST['elimina'])){
        $codigo =$_POST['Codigo'];
        include_once('includes/acceso.php');
        include_once('Clases/Camion.php');
        $conexion = connect_db();
        $oproducto = new Camion();
        $oproducto->conectar_db($conexion);
        $res=$oproducto->borrar($codigo);
        if ($res){
            header("Location: confirmacion.php");}
        else{
            header ("Location: error.php");}
    }

    else if(isset($_POST['volver'])){
        header("location: espresstacna.php");}

    else if(isset($_POST['guardado'])){

        $id =$_POST['Codigo'];
        $placa = $_POST['Placa'];
        $marca = $_POST['Marca'];
        $cer = $_POST['Certificado'];
        $conf = $_POST['CV'];
        $carga = $_POST['Carga_m'];
        include_once('includes/acceso.php');
        $conexion = connect_db();
        include('clases/Camion.php');
        $ncamion = new Camion();
        $ncamion->conectar_db($conexion);

        $response = $ncamion->nuevo_camion($id,$placa,$marca,$cer,$conf,$carga);
        if($response) {
            // Si el registro se guardó correctamente, mostramos un mensaje de confirmación
            header("location: confirmacion.php");
        } else 
            header("location: error.php");       
    }
    else if(isset($_POST['x'])){
        header("location: camiones.php");
    }
    else if(isset($_POST['xd'])){
        header("location: camiones_nuevo.php");
    }
    else if(isset($_POST['modificar'])){
        $id=$_POST['Codigo'];
        $nom =$_POST['Placa'];
        $und = $_POST['Marca'];
        $can = $_POST['Certificado'];
        $pre = $_POST['CV'];
        $cos = $_POST['Carga_m'];
        
        include_once('includes/acceso.php');
        include_once('Clases/Camion.php');
        $conexion = connect_db();
        $oproducto = new Camion();
        $oproducto->conectar_db($conexion);
        $response = $oproducto->modifica_camion($id,$nom,$und,$can,$pre,$cos);
        if($response) {
            header("location: confirmacion.php");
        } else {
            header("location: error.php");}
    }
    else if(isset($_POST['correcto']))
    {
        include_once('includes/acceso.php');
        include_once('Clases/Cliente.php');
        $conexion = connect_db();
        $cliente = new Cliente();
        $cliente->conectar_db($conexion);
        if (isset($_POST['Razon_social']))
            {$razon_social=$_POST['Razon_social'];}
        else{$razon_social = null;}
        if (isset($_POST['Nombre']))
            {$nomb=$_POST['Nombre'];}
        else{$nomb = null;}
        if (isset($_POST['Direccion']))
            {$dire=$_POST['Direccion'];}
        else{$dire = null;}
        if (isset($_POST['Telefono']))
            {$fono = $_POST['Telefono'];}
        else{$fono = null;}
        if (isset($_POST['RUC']))
            {$nruc = $_POST['RUC'];}
        else{$nruc = null;}
        if (isset($_POST['DNI']))
            {$dni = $_POST['DNI'];}
        else{$dni = null;}
        if (isset($_POST['Email']))
            {$email = $_POST['Email'];}
        else{$email = null;}

        if(isset($_GET['pagina_anterior'])) 
        {
            $pagina_anterior = $_GET['pagina_anterior'];
        }
        if($pagina_anterior === "/TacnaExpress/clientes_rapido.php")
        {
            $validacion = $_POST['Ruc_dni'];
            $conteo = strlen($validacion);
            if($conteo === 8)
            {   
                $dni = $validacion;
                $busca = $cliente->busca_dni($dni);
                if(isset($busca['CODC']))
                {
                    $codigo = $busca['CODC'];
                }
                if ($busca)
                {
                    echo "<script>
                    setTimeout(function() {
                        var confirmacion = confirm('El DNI Que Esta Intentando Ingresar Ya Fue Ingresado Anteriormente, ¿Desea Modificar Cliente?');
                        if (confirmacion) {
                            window.location.href = 'Cmodifica_cliente.php?codigo=$codigo';
                        } else {
                            window.location.href = 'espresstacna.php';
                        }
                    }, 0);
                    </script>";
                }
                else{
                    $fena = date('Y-m-d');
                    $c = 0;
                    $response = $cliente->nuevo_cliente($nomb,$razon_social,$fena,$nruc,$dni,$dire,$fono,$email,$c);
                    if($response) {
                        echo "<script>
                                alert('Registro De Cliente Exitoso');
                                window.location.href = 'espresstacna.php';
                            </script>";
                    } else {
                        echo "<script>
                        setTimeout(function() 
                        {
                            alert('Hubo Un Error Al Registrar Cliente, Intente Nuevamente');
                            window.location.href = 'clientes_rapido.php';
                        }, 0);
                        </script>";    
                    }
                }
            }
            else if($conteo >= 11)
            {
                $nruc=$_POST['Ruc_dni'];
                $busca = $cliente->buscar_nruc($nruc);
                $codigo = $busca['CODC'];
                if ($busca){
                    echo "<script>
                    setTimeout(function() {
                        var confirmacion = confirm('El RUC Que Esta Intentando Ingresar Ya Fue Ingresado Anteriormente, ¿Desea Modificar?');
                        if (confirmacion) {
                            window.location.href = 'Cmodifica_cliente.php?codigo=$codigo';
                        } else {
                            window.location.href = 'espresstacna.php';
                        }
                    }, 0);
                </script>";
                }
                else
                {
                    $fena = date('Y-m-d');
                    $c = 1;
                    $response = $cliente->nuevo_cliente($nomb,$razon_social,$fena,$nruc,$dni,$dire,$fono,$email,$c);
                    if($response) {
                        echo "<script>
                            setTimeout(function() 
                            {
                                alert('Registro De Cliente Exitoso');
                                window.location.href = 'espresstacna.php';
                            }, 5);
                            </script>";
                    } else {
                        echo "<script>
                        setTimeout(function() 
                        {
                            alert('Hubo Un Error Al Registrar Cleinte, Intente Nuevamente');
                            window.location.href = 'clientes_rapido.php';
                        }, 0);
                        </script>";    
                    }
                }
            }    
            else 
            {
                    //sleep(5);
                    //echo "<h1 style='color: black;'></h1>";
                    if ($conteo === 0)
                    {
                        echo "<script>
                        setTimeout(function() 
                        {
                            alert('DNI o RUC Vacio, Llenar para poder continuar');
                            window.location.href = 'clientes_rapido.php';
                        }, 0);
                        </script>";
                    }
                    else if ($conteo < 8)
                    {
                        echo "<script>
                        setTimeout(function() 
                        {
                            alert('DNI Incorrecto, Debe Tener 8 Digitos El que Ingreso Solo Tiene $conteo');
                            window.location.href = 'clientes_rapido.php';
                        }, 0);
                        </script>";
                    }
                    else if ($conteo > 8 || $conteo < 11)
                    {
                        echo "<script>
                        setTimeout(function() 
                        {
                            alert('RUC Incorrecto, Debe 11 o más Digitos El que Ingreso Solo Tiene $conteo');                        
                            window.location.href = 'clientes_rapido.php';
                        }, 0);
                        </script>";
                    }
                    //echo "<script>setTimeout(function() { window.location.href = 'clientes.php'; }, 5000);</script>";
                    // Redirigir a otra página después de mostrar el mensaje
                    //header("refresh:5; clientes.php");
                    //header("location: clientes.php"); 
            }            
        }
        else if($pagina_anterior === "/TacnaExpress/clientes.php")
        {
                $busca = $cliente->busca_dni($dni);
                if(isset($busca['CODC']))
                {
                    $codigo = $busca['CODC'];
                }
                if ($busca)
                {
                    echo "<script>
                    setTimeout(function() {
                        var confirmacion = confirm('El DNI Que Esta Intentando Ingresar Ya Fue Ingresado Anteriormente, ¿Desea Modificar Cliente?');
                        if (confirmacion) {
                            window.location.href = 'Cmodifica_cliente.php?codigo=$codigo';
                        } else {
                            window.location.href = 'espresstacna.php';
                        }
                    }, 0);
                    </script>";
                }
                else{
                    $fena = date('Y-m-d');
                    $c = 2;
                    $response = $cliente->nuevo_cliente($nomb,$razon_social,$fena,$nruc,$dni,$dire,$fono,$email,$c);
                    if($response) {
                        echo "<script>
                            setTimeout(function() 
                            {
                                alert('Registro De Cliente Exitoso');
                                window.location.href = 'espresstacna.php';
                            }, 0);
                            </script>";
                    } else {
                        echo "<script>
                        setTimeout(function() 
                        {
                            alert('Hubo Un Error Al Registrar Cliente, Intente Nuevamente');
                            window.history.go(-1);
                        }, 0);
                        </script>";    
                    }
                }
        }    
    }

    else if(isset($_POST['refrescar'])){
        if(isset($_GET['pagina_anterior'])) {
            $pagina_anterior = $_GET['pagina_anterior'];
            header("Location: " . $pagina_anterior);
            exit();
        }
    }
    else if(isset($_POST['modifica_cliente']))
    {
        include_once('includes/acceso.php');
        include_once('Clases/Cliente.php');
        $conexion = connect_db();
        $cliente = new Cliente();
        $cliente->conectar_db($conexion);
        $razon_social=$_POST['Razon_social'];
        $nomb=$_POST['Nombre'];
        $dire=$_POST['Direccion'];
        //$validacion = $_POST['Ruc_dni'];
        $fono = $_POST['Telefono'];
        $nruc = $_POST['RUC'];
        $dni = $_POST['DNI'];
        $email = $_POST['Email'];
        $id = $_POST['Codigo'];
        $fena = date('Y-m-d');
        //$conteo = strlen($validacion);
        $modifica = $cliente->modifica_cliente($id,$nomb,$razon_social,$fena,$nruc,$dni,$dire,$fono,$email);      
        if($modifica)
        {
            echo "<script>
            setTimeout(function() 
            {
                alert('Se Modifico El Cliente Con Éxito');
                window.location.href = 'espresstacna.php';
            }, 0);
            </script>";      
        }
        else
        {
            echo "<script>
                        setTimeout(function() 
                        {
                            alert('Hubo Un Error Al Modificar El Cliente, Vuelva A Intentar');
                            window.history.go(-1);
                        }, 0);
                </script>";
        }
    }
    else if(isset($_POST['guardar_ruta']))
    {
        include_once('includes/acceso.php');
        include_once('Clases/Ruta.php');
        $conexion = connect_db(); 
        $ruta = new Ruta;
        $ruta->conectar_db($conexion);
        $id = $_POST['CODIGO'];
        $dest = $_POST['DESTINO'];
        $abre = $_POST['ABREVIATURA'];
        $dire = $_POST['DIRECCION'];
        $nueva_ruta = $ruta->nueva_ruta($id,$dest,$abre,$dire);
        if($nueva_ruta)
        {
            echo"
            <script>
                alert('Se Registro La Nueva Ruta Con Exito');
                window.location.href = 'espresstacna.php';
            </script>
            ";
        }
        else
        {
            echo"
            <script>
                alert('Hubo Un Error Al Registrar La Ruta, Vuelva A Intentar');
                window.location.href = 'rutas.php';
            </script>
            ";
        }
    }

    else if(isset($_POST['cancel'])) 
    {
        echo '<script>window.history.go(-2);</script>';
    }

    else if(isset($_POST['busqueda']))
    {   
        $pagina_anterior = $_GET['pagina_anterior'];
        echo "$pagina_anterior";
        if($pagina_anterior === "/TacnaExpress/clientes.php")
        {   
            $tabla = "fmclinic";
            $titulo = "CLIENTES";
            header("location: busca_prueba.php?tabla=$tabla&titulo=$titulo");
        }
        else if($pagina_anterior === "/TacnaExpress/rutas.php")
        {
            $tabla = "ruta";
            $titulo = "RUTA";
            header("location: busca_prueba.php?tabla=$tabla&titulo=$titulo");
        }
        else if($pagina_anterior === "/TacnaExpress/empleados.php")
        {
            $tabla = "fuser";
            $titulo = "USUARIOS";
            header("location: busca_prueba.php?tabla=$tabla&titulo=$titulo");
        }
        else if($pagina_anterior === "/TacnaExpress/t_de_pago.php")
        {
            $tabla = "condiciones";
            $titulo = "TIPO DE PAGOS";
            header("location: busca_prueba.php?tabla=$tabla&titulo=$titulo");
        }
        else if($pagina_anterior === "/TacnaExpress/d_")
        {
            $tabla = "";
            $titulo = "";
            header("location: busca_prueba.php?tabla=$tabla&titulo=$titulo");
        }
    }
    else if(isset($_GET['codigo']))
    {
        $cod = $_GET['codigo'];
        $pag = $_GET['pag'];
        //echo "$pag";
        if($pag === "RUTA"){
        echo "
            <script>
                var confirmacion = confirm('¿Esta Seguro De Eliminar La Ruta?');
                if (confirmacion) {
                    window.location.href = 'rutas_elimina.php?codigo=$cod';
                } else {
                    window.history.back();
                }
            </script>";
        }
        else if($pag === "CLIENTES"){
            echo "
                <script>
                    var confirmacion = confirm('¿Esta Seguro De Eliminar Este Cliente?');
                    if (confirmacion) {
                        window.location.href = 'elimina_cliente.php?codigo=$cod';
                    } else {
                        window.history.back();
                    }
                </script>";
            }
            else if($pag === "USUARIOS"){
                echo "
                    <script>
                        var confirmacion = confirm('¿Esta Seguro De Eliminar Este Usuario?');
                        if (confirmacion) {
                            window.location.href = 'empleados_elimina.php?codigo=$cod';
                        } else {
                            window.history.back();
                        }
                    </script>";
                }
                else if($pag === "TIPO DE PAGOS"){
                    echo "
                        <script>
                            var confirmacion = confirm('¿Esta Seguro De Eliminar Este Tipo De Pago?');
                            if (confirmacion) {
                                window.location.href = 'tp_elimina.php?codigo=$cod';
                            } else {
                                window.history.back();
                            }
                        </script>";
                    }
    }
    else if (isset($_POST['registra']))
    {
        $act = isset($_POST["miCheck"]) && $_POST["miCheck"] === "on" ? 1 : 0;
        $nivel = isset($_POST["Nivel"]) && $_POST["Nivel"] === "1" ? 1 : 0;
        $cede = $_POST['Sede'];
        $cede = "0" . $cede;
        echo "El valor del checkbox es: " . $act . "<br>";
        echo "El valor del select es: " . $nivel;
        $nom= $_POST['Nombre'];
        $user = $_POST['Nombre_d_Usuario'];
        $pas = $_POST['Contraseñaa'];
        $dni=$_POST['DNI'];
        $bre = $_POST['Brevete'];
        $ocu = $_POST['Ocupacion'] ?? '';
        include_once('includes/acceso.php');
        include_once('clases/registra_usua.php');
        $conexion = connect_db();
        $oproduct = new Registro();
        $oproduct->conectar_db($conexion);
        
        $response = $oproduct->registrar_usuario($user,$pas,$nom,$nivel,$act,$ocu,$dni,$bre,$cede);

        if($response) {
            echo"
            <script>
                alert('Se Registro Nuevo Usuario Con Exito');
                window.location.href = 'espresstacna.php';
            </script>
            ";
        } else {
        echo"
            <script>
                alert('Hubo Un Error Inesperado Vuelve A Intentar');
                window.location.href = 'empleados.php';
            </script>
            ";
        }    
    }
    else if(isset($_POST['modificar_empleado']))
    {
        include_once('includes/acceso.php');
        include_once('clases/registra_usua.php');
        $conexion = connect_db();
        $usua = new Registro();
        $usua->conectar_db($conexion);
        $user = $_POST['Nombre_d_Usuario'];
        $busca = $usua->busca($user);
        $id = $busca['CODUSUARIO'];
        $pas = $_POST['Contraseñaa'];
        $nom= $_POST['Nombre'];
        $nivel= $_POST['Nivel'];
        $act = isset($_POST["miCheck"]) && $_POST["miCheck"] === "on" ? 1 : 0;
        $ocu= $_POST['Ocupacion'];
        $dni= $_POST['DNI'];
        $bre= $_POST['Brevete'];
        $cede= $_POST['Sede'];
        $cede = "0" . $cede;
        $modifica = $usua->modi_usuario($id,$user,$pas,$nom,$nivel,$act,$ocu,$dni,$bre,$cede);
        if($modifica) {
            echo"
            <script>
                alert('Se Modifico Usuario Con Exito');
                window.location.href = 'espresstacna.php';
            </script>
            ";
        } else {
            echo"
            <script>
                alert('Hubo Un Error Inesperado Vuelve A Intentar');
                window.history.back();
            </script>
            ";
        } 
        
    }
    else if(isset($_POST['modifica_ruta']))
    {
        include_once('includes/acceso.php');
        include_once('Clases/Ruta.php');
        $conexion = connect_db(); 
        $ruta = new Ruta;
        $ruta->conectar_db($conexion);
        $id = $_POST['CODIGO'];
        $dest = $_POST['DESTINO'];
        $abre = $_POST['ABREVIATURA'];
        $dire = $_POST['DIRECCION'];
        $mod_ruta = $ruta->modifica_ruta($id,$dest,$abre,$dire);
        if($mod_ruta)
        {
            echo"
            <script>
                alert('Se Modífico La Ruta Con Exito');
                window.location.href = 'espresstacna.php';
            </script>
            ";
        }
        else
        {
            echo"
            <script>
                alert('Hubo Un Error Al Modíficar La Ruta, Vuelva A Intentar');
                window.history.back();
            </script>
            ";
        }
    }
    else if (isset($_POST['guardar_tp']))
    {
        include_once('includes/acceso.php');
        include_once('Clases/TP.php');
        $id=$_POST['CODIGO'];
        $desc=$_POST['DESC'];
        $nd=$_POST['DIAS'];
        $tp=$_POST['TC'];
        $act = isset($_POST["miCheck"]) && $_POST["miCheck"] === "on" ? 1 : 0;
        $conexion = connect_db(); 
        $tc = new TP;
        $tc->conectar_db($conexion);
        $nueva_condicion = $tc->nueva_condicion($id,$desc,$nd,$tp,$act);
        if($nueva_condicion)
        {
            echo "<script>
            alert('Se Registro con éxito');
            window.location.href = 'espresstacna.php';
            </script>";
        }
        else
        {
            echo "<script>
            alert('Hubo Un Error Inesperado, Volver A Intentar');
            window.history.back();
            </script>";
        }
    }
    else if(isset($_POST['modificar_tc']))
    {
        include_once('includes/acceso.php');
        include_once('Clases/TP.php');
        $id=$_POST['CODIGO'];
        $desc=$_POST['DESC'];
        $nd=$_POST['DIAS'];
        $tp=$_POST['TC'];
        $act = isset($_POST["miCheck"]) && $_POST["miCheck"] === "on" ? 1 : 0;
        $conexion = connect_db(); 
        $tc = new TP;
        $tc->conectar_db($conexion);
        $nueva_condicion = $tc->modifica_condicion($id,$desc,$nd,$tp,$act);
        if($nueva_condicion)
        {
            echo "<script>
            alert('Se Modifico Con Éxito');
            window.location.href = 'espresstacna.php';
            </script>";
        }
        else
        {
            echo "<script>
            alert('Hubo Un Error Inesperado, Volver A Intentar');
            window.history.back();
            </script>";
        }
    }
    else if(isset($_POST['guardar_datosfijos']))
    {
        include_once('includes/acceso.php');
        include_once('Clases/Datos_Fijos.php');
        $conexion = connect_db();
        $df = new Datos_Fijos;
        $df->conectar_db($conexion);
        $fecha_transaccion = $_POST['FECHA'];
        $liquidacion = $_POST['LIQUI'];
        $codigo_camion = $_POST['CAMION']; 
        $codigo_chofer = $_POST['CHOFER'];
        $codigo_copiloto = $_POST['COPI'];
        $codigo_liquidador = $_POST['LIQUIDADOR'];
        $fecha_partida = $_POST['FECHA_PARTIDA'];
        $hora_partida = $_POST['HORA'];
        $direccion_partida = $_POST['PARTIDA'];
        $direccion_llegada_ilo = null;
        $direccion_llegada_moq = null;
        $direccion_llegada_tacna = null;
        $licencia = $_POST['LICE'];
        $user = $_SESSION["username"];
        $cede = mysqli_query($conexion, "SELECT * FROM fuser WHERE USUARIO = '$user'");
        $cede = mysqli_fetch_assoc($cede);
        $cede = $cede['CEDE'];
        $busca = $df->buscar($liquidacion);
        if($busca)
        {
            $dato_fijo = $df->modificar_datosfijos($fecha_transaccion, $liquidacion, $codigo_camion, $codigo_chofer, $codigo_copiloto, $codigo_liquidador, $fecha_partida, $hora_partida, $direccion_partida, $direccion_llegada_ilo, $direccion_llegada_moq, $direccion_llegada_tacna, $licencia, $cede);
            if($dato_fijo)
            {
                echo "<script>
                alert('Se Modifico Con Éxito');
                window.location.href = 'espresstacna.php';
                </script>";
            }
            else
            {
                echo "<script>
                alert('Hubo un Error Inesperado Volver A Intentar');
                window.history.back();
                </script>";
            }
        }
        else
        {
            $dato_fijo = $df->datos_fijos($fecha_transaccion, $liquidacion, $codigo_camion, $codigo_chofer, $codigo_copiloto, $codigo_liquidador, $fecha_partida, $hora_partida, $direccion_partida, $direccion_llegada_ilo, $direccion_llegada_moq, $direccion_llegada_tacna, $licencia, $cede);
            if($dato_fijo)
            {
                echo "<script>
                alert('Se Registro Con Éxito');
                window.location.href = 'espresstacna.php';
                </script>";
            }
            else
            {
                echo "<script>
                alert('Hubo un Error Inesperado Volver A Intentar');
                window.history.back();
                </script>";
            }
        }
    }
    else{
        echo "Intente de nuevo, algo sucedio mal <a class = 'nav-link' href = 'espresstacna.php'>Volver</a>";
    }

?>

