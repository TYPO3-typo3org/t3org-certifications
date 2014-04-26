<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Certlist',
	array(
		'FeUsers' => 'list, listSorted, show',

	),
	// non-cacheable actions
	array(
		'FeUsers' => 'listSorted',

	)
);

?>