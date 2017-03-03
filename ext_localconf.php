<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'T3o.' . $_EXTKEY,
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