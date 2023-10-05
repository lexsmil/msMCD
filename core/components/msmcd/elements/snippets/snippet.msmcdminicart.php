<?php

/** @var modX $modx */
/** @var array $scriptProperties */
/** @var msMCD $msMCD */
if (!$msMCD = $modx->getService('msmcd', 'msMCD', $modx->getOption(
    'msmcd_core_path',
    null,
    $modx->getOption('core_path') . 'components/msmcd/'
) . 'model/msmcd/', $scriptProperties)) {
    return '';
}

$tplOuter = $modx->getOption('tplOuter', $scriptProperties, 'msMCDMiniCartOuterTpl');
$tpl = $modx->getOption('tpl', $scriptProperties, 'msMCDMiniCartRowTpl');
$img = trim($modx->getOption('img', $scriptProperties, ''));
$jsUrl = $modx->getOption('jsUrl', $scriptProperties, 'components/msmcd/js/web/msmcdminicart.js');
$animate = (bool) $modx->getOption('animate', $scriptProperties, $modx->getOption('msmcd_animate_mini_cart', null, false));
$dropdown = (bool) $modx->getOption('dropdown', $scriptProperties, $modx->getOption('msmcd_dropdown_mini_cart', null, false));
$changeCount = (bool) $modx->getOption('changeCount', $scriptProperties, $modx->getOption('msmcd_change_count_mini_cart', null, false));

$output = '';
$_SESSION['msMCD']['data'] = $scriptProperties;
$output = $msMCD->getMCDChunk($tpl, $tplOuter);
$data = [
    'actionUrl' => $msMCD->config['actionUrl'],
    'animate' => $animate,
    'dropdown' => $dropdown,
    //    'changeCount' => $changeCount,
    'ctx' => $modx->context->key,
];
$modx->regClientHTMLBlock('<script>msMCDMiniCartConfig =' . json_encode($data) . '</script>');

if (!empty($jsUrl)) {
    $modx->regClientScript(MODX_ASSETS_URL . $jsUrl);
}

return $output;
