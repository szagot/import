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
                <td>Nome</td>
                <td>Valor Atual</td>
                <td>Valor Enviado</td>
                <td>Estoque Atual</td>
                <td>Estoque Enviado</td>
            </tr>
            <?php
            foreach ($alter as $ref => $produto) {
                $proId = $produto[ 'proId' ];
                ?>
                <tr class="prod">
                    <td>
                        <!-- ID do Produto -->
                        <input type="hidden" name="pro_id[]" value="<?= $proId ?>">
                        <input type="hidden" name="pro_ref[<?= $proId ?>]" value="<?= $ref ?>">
                        <!-- Referência do Produto -->
                        <?= $ref ?>
                    </td>
                    <td><?= $produto[ 'proNome' ] ?></td>
                    <td><?= $produto[ 'valueOri' ] ?></td>
                    <td><input type="text" name="value[<?= $proId ?>]" value="<?= $produto[ 'valueAlt' ] ?>"></td>
                    <td><?= $produto[ 'stockOri' ] ?></td>
                    <td><input type="text" name="stock[<?= $proId ?>]" value="<?= $produto[ 'stockAlt' ] ?>"></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <label class="btns">
        <button class="btn confirma" type="submit">Confima Atualização de Dados</button>
        <button class="btn cancela" type="button" onclick="window.location = './stock.php';">Cancelar</button>
    </label>
</form>

</body>
</html>