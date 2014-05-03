<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_certifications_domain_model_user'] = array(
	'ctrl' => $TCA['tx_certifications_domain_model_user']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'first_name, middle_name, last_name, country, email',
	),
	'feInterface' => 'first_name, middle_name, last_name, country, email',
	'types' => array(
		'0' => array('showitem' => '
			disable,first_name,middle_name,last_name,country,
			--div--;LLL:EXT:cms/locallang_tca.xml:fe_users.tabs.access, starttime, endtime,
			--div--;LLL:EXT:cms/locallang_tca.xml:fe_users.tabs.extended,email,public_email_address,twitter,public_twitter,cert_reason,certificates,fe_user
		')
	),
	'palettes' => array(
		'2' => array('showitem' => 'first_name,--linebreak--,middle_name,--linebreak--,last_name')
	),
	'columns' => array(
		'first_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.first_name',
			'config' => array(
				'type' => 'input',
				'size' => '25',
				'eval' => 'trim',
				'max' => '50'
			)
		),
		'middle_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.middle_name',
			'config' => array(
				'type' => 'input',
				'size' => '25',
				'eval' => 'trim',
				'max' => '50'
			)
		),
		'last_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.last_name',
			'config' => array(
				'type' => 'input',
				'size' => '25',
				'eval' => 'trim',
				'max' => '50'
			)
		),
		'country' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.country',
			'config' => array(
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max' => '40'
			)
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.email',
			'config' => array(
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max' => '80'
			)
		),
		'disable' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.disable',
			'config' => array(
				'type' => 'check'
			)
		),
		'starttime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'date',
				'default' => '0',
			)
		),
		'endtime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'date',
				'default' => '0',
				'range' => array(
					'upper' => mktime(0,0,0,12,31,2020),
				)
			)
		),
		'cert_reason' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.cert_reason',
			'config' => array(
				'type' => 'input',
				'size' => 50,
				'eval' => 'trim'
			),
		),
		'public_email_address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.public_email_address',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'twitter' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.twitter',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'max' => 15,
				'eval' => 'trim'
			)
		),
		'public_twitter' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.public_twitter',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'certificates' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.certificates',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_certifications_domain_model_certificate',
				'foreign_field' => 'user',
				'foreign_default_sortby' => 'certification_date',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 0,
					'showPossibleLocalizationRecords' => 0,
					'showAllLocalizationLink' => 0
				),
			),
		),
		'fe_user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.fe_user',
			'config' => Array (
				'type' => 'select',
				'size' => 1,
				'minitems' => 0,
				'maxitems' => 1,
				'foreign_table' => 'fe_users',
				'items' => array (
					array('', ''),
					array('LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_user.fe_user', '--div--'),
				),
				'wizards' => Array(
					'suggest' => array(
						'type' => 'suggest'
					)
				),
			)
		),
	),
);


?>