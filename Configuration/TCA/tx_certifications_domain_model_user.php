<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return [
    'ctrl' => [
        'title' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user',
        'label' => 'email',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'disable',
        ],
        'searchFields' => 'first_name,last_name,email,twitter',
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('certifications') . 'Configuration/TCA/User.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('certifications') . 'Resources/Public/Icons/tx_certifications_domain_model_user.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'first_name, middle_name, last_name, country, email',
    ],
    'feInterface' => 'first_name, middle_name, last_name, country, email',
    'types' => [
        '0' => ['showitem' => '
			disable,first_name,middle_name,last_name,country,
			--div--;LLL:EXT:cms/locallang_tca.xml:fe_users.tabs.access, starttime, endtime,
			--div--;LLL:EXT:cms/locallang_tca.xml:fe_users.tabs.extended,email,public_email_address,twitter,public_twitter,cert_reason,certificates,fe_user
		']
    ],
    'palettes' => [
        '2' => ['showitem' => 'first_name,--linebreak--,middle_name,--linebreak--,last_name']
    ],
    'columns' => [
        'first_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.first_name',
            'config' => [
                'type' => 'input',
                'size' => '25',
                'eval' => 'trim',
                'max' => '50'
            ]
        ],
        'middle_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.middle_name',
            'config' => [
                'type' => 'input',
                'size' => '25',
                'eval' => 'trim',
                'max' => '50'
            ]
        ],
        'last_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.last_name',
            'config' => [
                'type' => 'input',
                'size' => '25',
                'eval' => 'trim',
                'max' => '50'
            ]
        ],
        'country' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.country',
            'config' => [
                'type' => 'input',
                'size' => '20',
                'eval' => 'trim',
                'max' => '40'
            ]
        ],
        'email' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.email',
            'config' => [
                'type' => 'input',
                'size' => '20',
                'eval' => 'trim',
                'max' => '80'
            ]
        ],
        'disable' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.disable',
            'config' => [
                'type' => 'check'
            ]
        ],
        'starttime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => '8',
                'max' => '20',
                'eval' => 'date',
                'default' => '0',
            ]
        ],
        'endtime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => '8',
                'max' => '20',
                'eval' => 'date',
                'default' => '0',
                'range' => [
                    'upper' => mktime(0, 0, 0, 12, 31, 2020),
                ]
            ]
        ],
        'cert_reason' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.cert_reason',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'eval' => 'trim'
            ],
        ],
        'public_email_address' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.public_email_address',
            'config' => [
                'type' => 'check',
                'default' => 0
            ],
        ],
        'twitter' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.twitter',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'max' => 15,
                'eval' => 'trim'
            ]
        ],
        'public_twitter' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.public_twitter',
            'config' => [
                'type' => 'check',
                'default' => 0
            ],
        ],
        'certificates' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.certificates',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_certifications_domain_model_certificate',
                'foreign_field' => 'user',
                'foreign_default_sortby' => 'certification_date',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 0,
                    'showPossibleLocalizationRecords' => 0,
                    'showAllLocalizationLink' => 0
                ],
            ],
        ],
        'fe_user' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.fe_user',
            'config' => [
                'type' => 'select',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
                'foreign_table' => 'fe_users',
                'items' => [
                    ['', ''],
                    ['LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.fe_user', '--div--'],
                ],
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest'
                    ]
                ],
            ]
        ],
    ],
];


?>