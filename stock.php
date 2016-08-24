<?php
/**
 * Importador de estoque/preço
 *
 * Espera um arquivo CSV no seguinte formato
 *      REF;VALOR;ESTOQUE
 *      100;99.99;20
 */

require_once '../config/conecta.class.php';

// Enviado algum arquivo CSV? Se não, vai pro form
if (! isset($_FILES[ 'img_file' ][ 'name' ]) || ! preg_match('/\.csv$/i', $_FILES[ 'img_file' ][ 'name' ])) {

    // Montando form
    $authorized = true;
    require_once 'nav/form.php';
    exit;
}