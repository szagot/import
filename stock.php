<?php
/**
 * Importador de estoque/preço
 *
 * Espera um arquivo CSV no seguinte formato
 *      REF;VALOR;ESTOQUE
 *      100;99.99;20
 */

// Enviado algum arquivo CSV? Se não, vai pro form
if (! isset($_FILES[ 'csv_file' ]) || ! preg_match('/\.csv$/i', $_FILES[ 'csv_file' ][ 'name' ])) {

    // Montando form
    $authorized = true;
    require_once 'nav/form.php';
    exit;
}

require_once '../config/conecta.class.php';
$pdo = new Conecta();

// Pegando CSV
$csv = explode('|', preg_replace('/[\n\r]+/', '|', file_get_contents($_FILES[ 'csv_file' ][ 'tmp_name' ])));

// Lendo arquivo
$alter = [];
foreach ($csv as $linha) {
    // se não for válido, pula
    if (! preg_match('/;[0-9.]+;[0-9-]+$/', $linha)) {
        continue;
    }

    list($ref, $value, $estoque) = explode(';', $linha);

    $ref = trim($ref);
    $value = (($value * 1) > 0 ? ($value * 1) : 0);
    $estoque = (($estoque * 1) > 0 ? ($estoque * 1) : 0);

    $produto = $pdo->execute("SELECT PRO_ID, PRO_ESTOQUE, PRO_VALOR FROM produto WHERE PRO_REF = '$ref'", true);

    // Se produto não encontrado, prossgue
    if (! isset($produto->PRO_ID)) {
        continue;
    }

    // Se não há mudança, prossegue
    if (($produto->PRO_VALOR * 1) == $value && ($produto->PRO_ESTOQUE * 1) == $estoque) {
        continue;
    }

    $alter[ $ref ] = [
        'valueAlt' => $value,
        'stockAlt' => $estoque,
        'valueOri' => $produto->PRO_VALOR,
        'stockOri' => $produto->PRO_ESTOQUE,
        'proId'    => $produto->PRO_ID
    ];
}

require_once 'nav/lista.php';
exit;