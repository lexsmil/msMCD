<?php

/** @var modX $modx */
/** @var array $scriptProperties */
/** @var msMCD $msMCD */
if (!$msMCD = $modx->getService('msmcd', 'msMCD', $modx->getOption('msmcd_core_path', null,
        $modx->getOption('core_path') . 'components/msmcd/') . 'model/msmcd/', $scriptProperties)
) {
    return '';
}

$tpl = $modx->getOption('tpl', $scriptProperties, 'msMCDCountTpl', true);
$jsUrl = trim($modx->getOption('jsUrl', $scriptProperties, 'components/msmcd/js/web/msmcdcount.js'));
$id = $modx->getOption('id', $scriptProperties, $modx->resource->id, true);

$output = '';

$cart = $msMCD->getCart();
$data = array(
    'action' => 'cart/add',
    'count' => '',
);

if ($cart) {
    foreach ($cart as $key => $item) {
        if ($id == $item['id']) {
            $data['key'] = $key;
            $data['count'] = $item['count'];
            $data['action'] = 'cart/change';
        }
    }
}

$output = $msMCD->getChunk($tpl, $data);

if (!empty($jsUrl)) {
    $hash = spl_object_hash($modx);
    if ($_SESSION['msMCD']['tmp'] != $hash) {
        $_SESSION['msMCD']['tmp'] = $hash;
        $modx->regClientScript(MODX_ASSETS_URL . $jsUrl);
    }
}
return $output;