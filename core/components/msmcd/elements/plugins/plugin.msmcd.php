<?php

/** @var array $scriptProperties */
/** @var modX $modx */
/** @var msMCD $msMCD */
if (!$msMCD = $modx->getService('msmcd', 'msMCD', $modx->getOption(
    'msmcd_core_path',
    null,
    $modx->getOption('core_path') . 'components/msmcd/'
) . 'model/msmcd/', $scriptProperties)) {
    return '';
}

switch ($modx->event->name) {
    case 'msOnBeforeAddToCart':
        $productData = array_merge(
            $product->toArray(),
            ['count' => $count]
        );
        $msMCD->setSessionProduct($productData);
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
