<?php

$properties = [];

$tmp = [
    'tpl' => [
        'type' => 'textfield',
        'value' => 'msMCDCountTpl',
    ],
    'jsUrl' => [
        'type' => 'textfield',
        'value' => 'components/msmcd/js/web/msmcdcount.js',
    ],
    'id' => [
        'type' => 'textfield',
        'value' => '[[+id]]',
    ],
];

foreach ($tmp as $k => $v) {
    $properties[] = array_merge([
        'name' => $k,
        'desc' => PKG_NAME_LOWER . '_prop_' . $k,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ], $v);
}

return $properties;