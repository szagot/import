<?php
if (! isset($alter)) {
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

        <form id="dados_up" action="" method="post">
            <div class="border">
                <table width="100%" border="0" cellspacing="3" cellpadding="0" align="center">
                    <tbody>
                    <tr class="title">
                        <td>Referência</td>
                        <td>Valor Original</td>
                        <td>Valor à ser Alterado</td>
                        <td>Estoque Original</td>
                        <td>Estoque à ser Alterado</td>
                    </tr>
                    <?php
                    foreach ($alter as $ref => $produto) {
                        ?>
                        <tr class="prod">
                            <td>
                                <!-- ID do Produto -->
                                <input type="hidden" value="<?= $produto[ 'proId' ] ?>">
                                <!-- Referência do Produto -->
                                <?= $ref ?>
                            </td>
                            <td><?= $produto[ 'valueOri' ] ?></td>
                            <td><input type="text" name="valueAlt" value="<?= $produto[ 'valueAlt' ] ?>"></td>
                            <td><?= $produto[ 'stockOri' ] ?></td>
                            <td><input type="text" name="stockAlt" value="<?= $produto[ 'stockAlt' ] ?>"></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <button class="btn confirma" type="submit">Confimar</button>
            <button class="btn cancela" type="button">Cancelar</button>
        </form>

    </body>
</html>