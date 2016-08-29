<?php
/**
 * Importador de estoque/preço
 *
 * Espera um arquivo CSV no seguinte formato
 *      REF;VALOR;ESTOQUE
 *      100;99.99;20
 */
if (! isset($_SESSION[ 'TMWXD' ])) {
    @session_start();
}

date_default_timezone_set('America/Sao_Paulo');

if ((time() - $_SESSION[ 'TMWXD' ][ 'acesso' ]) > $_SESSION[ 'TMWXD' ][ 'periodo' ]) {
    // Deslogar ao final do período
    die('Acesso negado.');
}

require_once '../config/conecta.class.php';
$pdo = new Conecta();

// Verificando se houve salvamento
$proIds = filter_input_array(INPUT_POST);

if (! empty($proIds)) {
    // Começa o salvamento dos dados
    $erros = [];
    $alterados = 0;
    foreach ($proIds[ 'pro_id' ] as $proId) {
        // Verifica se dados são válidos
        $proIds[ 'value' ][ $proId ] = str_replace(',', '.', $proIds[ 'value' ][ $proId ]);
        if (! is_numeric($proIds[ 'value' ][ $proId ])) {
            $erros[] = "O valor <b>{$proIds['value'][$proId]}</b> do produto <b>{$proIds['pro_ref'][$proId]}</b> não é válido";
            continue;
        }

        if (! is_numeric($proIds[ 'stock' ][ $proId ])) {
            $erros[] = "O estoque <b>{$proIds['stock'][$proId]}</b> do produto <b>{$proIds['pro_ref'][$proId]}</b> não é válido";
            continue;
        }

        $pdo->zeraVars('produto');
        $pdo->setVars([
            'type'   => 'UPDATE',
            'where'  => "PRO_ID = '$proId'",
            'campos' => [
                'PRO_PROMOCAO'  => 0,
                'PRO_PROMO_INI' => null,
                'PRO_PROMO_FIM' => null,
                'PRO_VALOR'     => $proIds[ 'value' ][ $proId ],
                'PRO_ESTOQUE'   => $proIds[ 'stock' ][ $proId ],
            ]
        ]);

        if (! $pdo->execute()) {
            $erros[] = "Ocorreu um ero na atualização do produto. | {$pdo->erro}";
            continue;
        }

        $alterados++;
    }
}

// Enviado algum arquivo CSV? Se não, vai pro form
if (! isset($_FILES[ 'csv_file' ]) || ! preg_match('/\.csv$/i', $_FILES[ 'csv_file' ][ 'name' ])) {
    // Montando form
    $authorized = true;
    require_once 'nav/form.php';
    exit;
}

// Pegando CSV
$csv = explode('|', preg_replace('/[\n\r]+/', '|', file_get_contents($_FILES[ 'csv_file' ][ 'tmp_name' ])));

// Lendo arquivo
$alter = [];
foreach ($csv as $linha) {
    // se não for válido, pula
    if (! preg_match('/;[0-9,.]+;[0-9-]+$/', $linha)) {
        continue;
    }

    list($ref, $value, $estoque) = explode(';', $linha);

    $ref = trim($ref);
    $value = str_replace(',', '.', $value) * 1;
    $value = $value > 0 ? $value : 0;
    $estoque = (($estoque * 1) > 0 ? ($estoque * 1) : 0);

    $produto = $pdo->execute(
        "SELECT PRO_ID, PRO_NOME, PRO_ESTOQUE, PRO_VALOR FROM produto WHERE PRO_REF = '$ref'",
        true
    );

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
        'proId'    => $produto->PRO_ID,
        'proNome'  => $produto->PRO_NOME,
    ];
}

// Se não houver itens
if (count($alter) == 0) {
    header('Location: ./stock.php#empty');
    exit;
}

require_once 'nav/lista.php';
exit;