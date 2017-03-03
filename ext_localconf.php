<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
    $_EXTKEY,
    'Certlist',
    [
        'Listing' => 'list, show',

    ],
    // non-cacheable actions
    [
        //'Listing' => 'listSorted',

    ]
);

?>