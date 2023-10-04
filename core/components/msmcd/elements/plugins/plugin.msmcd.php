<?php
/** @var array $scriptProperties */
/** @var modX $modx */
/** @var msMCD $msMCD */
if (!$msMCD = $modx->getService('msmcd', 'msMCD', $modx->getOption('msmcd_core_path', null,
        $modx->getOption('core_path') . 'components/msmcd/') . 'model/msmcd/', $scriptProperties)
) {
    return '';
}

switch ($modx->event->name) {
    case 'msOnBeforeAddToCart':
        $msMCD->setSessionProduct($product->toArray());
        break;

    case 'msOnBeforeChangeInCart':
        $cart = $cart->get();
        $msMCD->updateSumRow($key, $count, $cart[$key]['price']);
        break;

    case 'msOnAddToCart':
    case 'msOnChangeInCart':
        $msMCD->updateMiniCart($key);
        unset($_SESSION['msMCD']['product']);
        break;
}