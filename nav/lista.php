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

        <form action="" method="post">

            <?php
            foreach ($alter as $ref => $produto) {
                ?>
                <ul>
                    <li>ID<?= $produto[ 'proId' ] ?> | REF<?= $ref ?></li>
                    <ul>
                        <li>Valor a ser Alterado<?= $produto[ 'valueAlt' ] ?></li>
                        <li>Valor Original<?= $produto[ 'valueOri' ] ?></li>
                        <li>Estoque a ser Alterado<?= $produto[ 'stockAlt' ] ?></li>
                        <li>Estoque Original<?= $produto[ 'stockOri' ] ?></li>
                    </ul>
                </ul>
                <?php
            }
            ?>

            <?php
            foreach ($alter as $ref => $produto) {
                ?>
                <table>
                    <tr>
                        <td>REF:</td>
                        <td>Valor à ser Alterado</td>
                        <td>Valor Original</td>
                        <td>Estoque à ser Alterado</td>
                        <td>Estoque Original</td>
                    </tr>
                    <tr>
                        <td>
                            <!-- ID do Produto -->
                            <input type="hidden" value="<?= $produto[ 'proId' ] ?>">
                            <!-- Referência do Produto -->
                            <?= $ref ?>
                        </td>
                        <tr><?= $produto[ 'valueAlt' ] ?></tr>
                        <tr><?= $produto[ 'valueOri' ] ?></tr>
                        <tr><?= $produto[ 'stockAlt' ] ?></tr>
                        <tr><?= $produto[ 'stockOri' ] ?></tr>
                    </tr>
                </table>
                <?php
            }
            ?>
            
        </form>

    </body>
</html>