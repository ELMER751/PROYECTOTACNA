<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #customMsgBox {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            padding: 20px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        #customMsgBox .title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        #customMsgBox .message {
            margin-bottom: 20px;
        }
        #customMsgBox .buttons {
            text-align: right;
        }
        #customMsgBox .buttons button {
            margin-left: 10px;
        }
        #overlay {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>
</head>
<body>
    <div id="overlay" style="display: none"></div>
    <div id="customMsgBox">
        <div class="title" id="msgBoxTitle">Alerta</div>
        <div class="message" id="msgBoxMessage">Documento Ya Esta Asociado a Nota de Credito, Verifique</div>
        <div class="buttons">
            <button onclick="closeCustomMsgBox()">Aceptar</button>
        </div>
    </div>

    <script>
        function showCustomMsgBox(message, title) {
            document.getElementById('msgBoxTitle').innerText = title || 'Mensaje';
            document.getElementById('msgBoxMessage').innerText = message;
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('customMsgBox').style.display = 'block';
        }

        function closeCustomMsgBox() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('customMsgBox').style.display = 'none';
        }

        // Ejemplo de uso:
        showCustomMsgBox('Documento Ya Esta Asociado a Nota de Credito, Verifique', 'Alerta');
    </script>
</body>
</html>