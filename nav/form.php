<?php
if (! isset($authorized)) {
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Atualizador de Estoque e Preço</title>
        <link href="nav/estilo.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form enctype="multipart/form-data" action="" method="post">
            <label>Arquivo CSV: <input type="file" name="csv_file"></label>
            <label class="btns envio">
                <button class="btn envio" type="submit">Enviar</button>
            </label>
            <div class="modelo">
                <strong class="title">Modelo de arquivo CSV</strong>
                <pre>
REFERENCIA;VALOR;ESTOQUE
REF0000001;99.99;20
REF0000002;88.00;100
                </pre>
            </div>
        </form>

        <div id="empty" class="modal-box">
            <div class="modal-content">
                <p>
                    <b>Arquivo sem registros válidos</b>
                </p>
                <p>
                    Verifique se o arquivo enviado possui a extensão CSV,
                    se possui os campos <b>Referência</b>, <b>Valor</b> e <b>Estoque</b> e
                    se estão separados por ponto-e-vírgula.
                </p>
                <a href="#close" class="close-link">X</a>
            </div>
        </div>

        <?php
        // Dados foram enviados?
        if (isset($erros)) {
            ?>
            <div id="msg" class="modal-box">
                <div class="modal-content">
                    <p>
                        <b><?= $alterados ?> registro(s) alterado(s).</b>
                    </p>
                    <?php if (count($erros) > 0) { ?>
                        <p class="erros">
                            Ocorreram os seguintes erros:<br>
                            <?php foreach ($erros as $erro) {
                                echo "<br> - $erro";
                            } ?>
                        </p>
                    <?php } ?>
                    <a href="#close" class="close-link">X</a>
                </div>
            </div>
            <script>
                window.location = '#msg';
            </script>
            <?php
        }
        ?>
    </body>
</html>