<html>
<head>
  <meta charset="UTF-8">
  <title>Calculadora</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="Css/calculadora.css">
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="js/calculadora.js" ></script>  

</head>
<body class="flexbox-base">
  <div class="calculadora">
    <div class="visor">
      <div class="visor__input" id="display"></div>
    </div>
    <div class="botones flexbox-base">
      <div class="flexbox-base botones__contenedor">
        <div class="flexbox-base operadores--especiales"> 
          <div class="boton-container"><button id="boton-ac" class="boton">C</button></div>
          <div class="boton-container"><button id="boton-signo" class="boton">+/-</button></div>
          <div class="boton-container"><button id="boton-porcentaje" class="boton">%</button></div>
        </div>
        <div class="flexbox-base operadores--numeros">
           <!--<div class="boton-container"><button class="boton" data-numero="9" >9</button></div>
          <div class="boton-container"><button class="boton" data-numero="8" >8</button></div>
          <div class="boton-container"><button class="boton" data-numero="7" >7</button></div>
          <div class="boton-container"><button class="boton" data-numero="6" >6</button></div>
          <div class="boton-container"><button class="boton" data-numero="5" >5</button></div>
          <div class="boton-container"><button class="boton" data-numero="4" >4</button></div>
          <div class="boton-container"><button class="boton" data-numero="3" >3</button></div>
          <div class="boton-container"><button class="boton" data-numero="2" >2</button></div>
          <div class="boton-container"><button class="boton" data-numero="1" >1</button></div>
          <div class="boton-container"><button class="boton" data-numero="." >.</button></div>
          <div class="boton-container doble"><button class="boton" data-numero="0" >0</button></div>-->
        </div>
      </div>
      <div class="flexbox-base operadores--basicos">
          <div class="boton-container"><button data-operacion="/"  class="boton">/</button></div>
          <div class="boton-container"><button data-operacion="*"  class="boton">*</button></div>
          <div class="boton-container"><button data-operacion="-"  class="boton">-</button></div>
          <div class="boton-container"><button data-operacion="+"  class="boton">+</button></div>
          <div class="boton-container"><button data-operacion="=" class="boton">=</button></div>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">  
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <a class="navbar-toggler-icon" href="espresstacna.php">Volver</a>
      </button>
          </li>   
        </ul>
      </div> 
  </div> 
</body>
</html>