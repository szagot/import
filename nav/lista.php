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
                            <td width="1">Referência</td>
                            <td width="">Nome</td>
                            <td width="70">Valor Atual</td>
                            <td width="70">Valor Enviado</td>
                            <td width="60">Estoque Atual</td>
                            <td width="60">Estoque Enviado</td>
                        </tr>
                        <?php
                        foreach ($alter as $ref => $produto) {
                            $proId = $produto[ 'proId' ];
                            ?>
                            <tr class="prod">
                                <td class="nobreak">
                                    <!-- ID do Produto -->
                                    <input type="hidden" name="pro_id[]" value="<?= $proId ?>">
                                    <input type="hidden" name="pro_ref[<?= $proId ?>]" value="<?= $ref ?>">
                                    <!-- Referência do Produto -->
                                    <?= $ref ?>
                                </td>
                                <td align="left"><?= $produto[ 'proNome' ] ?></td>
                                <td class="nobreak">R$ <?= number_format($produto[ 'valueOri' ], 2, ',', '') ?></td>
                                <td class="alt"><input type="number" step="any" name="value[<?= $proId ?>]"
                                                       value="<?= number_format($produto[ 'valueAlt' ], 2, '.', '') ?>">
                                </td>
                                <td><?= $produto[ 'stockOri' ] ?></td>
                                <td class="alt"><input type="number" name="stock[<?= $proId ?>]"
                                                       value="<?= $produto[ 'stockAlt' ] ?>" min="0"></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="btns">
                <button class="btn confirma" type="submit">Confimar Atualização de Dados</button>
                <button class="btn cancela" type="button" onclick="window.location = './stock.php';">Cancelar</button>
            </div>
        </form>

    </body>
</html>