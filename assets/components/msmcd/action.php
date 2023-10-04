<?php
/** @var modX $modx */
/** @var msMCD $msMCD */

if (empty($_REQUEST['action'])) {
    die('Access denied');
} else {
    $action = $_REQUEST['action'];
    $ctx = $_REQUEST['ctx'];
}

define('MODX_API_MODE', true);
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';

$modx->getService('error', 'error.modError');
$modx->getRequest();
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');
$modx->error->message = null;

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    $modx->sendRedirect($modx->makeUrl($modx->getOption('site_start'),'','','full'));
}

$msMCD = $modx->getService('msmcd', 'msMCD', $modx->getOption('msmcd_core_path', null,
        $modx->getOption('core_path') . 'components/msmcd/') . 'model/msmcd/');

if ($modx->error->hasError() || !($msMCD instanceof msMCD)) {
    die('Error');
}

$response = $msMCD->handleRequest($action, $ctx);

if (is_array($response)) {
    $response = json_encode($response);
}

@session_write_close();
exit($response);