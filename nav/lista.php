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
                        <td><?= $produto[ 'valueOri' ] ?></td>
                        <td><?= $produto[ 'valueAlt' ] ?></td>
                        <td><?= $produto[ 'stockOri' ] ?></td>
                        <td><?= $produto[ 'stockAlt' ] ?></td>
                    </tr>
                </table>
                <?php
            }
            ?>
            
        </form>

    </body>
</html>