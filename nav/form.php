<?php
if (! isset($authorized)) {
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Gerador de Planilha da B2W</title>
        <link href="nav/estilo.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form enctype="multipart/form-data" action="" method="post">
            <label>Arquivo CSV: <input type="file"></label>
            <button class="btn" type="submit">Enviar</button>
        </form>

        <div id="empty" class="modal-box">
            <div class="modal-content">
                <p>
                    <b>Arquivo inválido</b>
                </p>
                <p>
                    Verifique se o arquivo enviado possui a extensão CSV,
                    se possui os campos <b>Referência</b>, <b>Valor</b> e <b>Estoque</b> e
                    se estão separados por ponto-e-vírgula.
                </p>
                <a href="#close" class="close-link">X</a>
            </div>
        </div>
    </body>
</html>