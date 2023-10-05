<?php

$properties = [];

$tmp = [
    'tplOuter' => [
        'type' => 'textfield',
        'value' => 'msMCDMiniCartOuterTpl',
    ],
    'tpl' => [
        'type' => 'textfield',
        'value' => 'msMCDMiniCartRowTpl',
    ],
    'jsUrl' => [
        'type' => 'textfield',
        'value' => 'components/msmcd/js/web/msmcdminicart.js',
    ],
    'img' => [
        'type' => 'textfield',
        'value' => 'small',
    ],
    /*
    'animate' => [
        'type' => 'combo-boolean',
        'value' => false,
    ],
    'dropdown' => [
        'type' => 'combo-boolean',
        'value' => false,
    ],
    'changeCount' => [
        'type' => 'combo-boolean',
        'value' => false,
    ],
    */
];

foreach ($tmp as $k => $v) {
    $properties[] = array_merge([
        'name' => $k,
        'desc' => PKG_NAME_LOWER . '_prop_' . $k,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ], $v);
}

return $properties;
