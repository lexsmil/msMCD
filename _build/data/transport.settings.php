<?php

$settings = [];

$tmp = [
    'fields_mini_cart' => [
        'xtype' => 'textfield',
        'value' => 'pagetitle',
        'area' => 'msmcd_mini_cart',
    ],
    'animate_mini_cart' => [
        'xtype' => 'combo-boolean',
        'value' => false,
        'area' => 'msmcd_mini_cart',
    ],
    'dropdown_mini_cart' => [
        'xtype' => 'combo-boolean',
        'value' => false,
        'area' => 'msmcd_mini_cart',
    ],
];

/** @var modX $modx */
foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		[
			'key' => 'msmcd_' . $k,
			'namespace' => PKG_NAME_LOWER,
        ], $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
