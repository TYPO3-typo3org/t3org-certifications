<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
    $_EXTKEY,
    'Certlist',
    'Certification List'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Certifications');

$TCA['tt_content']['types']['list']['subtypes_addlist']['certifications_certlist'] = 'pi_flexform';

t3lib_extMgm::addPiFlexFormValue('certifications_certlist', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Certlist.xml');


t3lib_extMgm::addLLrefForTCAdescr('tx_certifications_domain_model_certificate', 'EXT:certifications/Resources/Private/Language/locallang_csh_tx_certifications_domain_model_certificate.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_certifications_domain_model_certificate');
$TCA['tx_certifications_domain_model_certificate'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_certificate',
        'label' => 'certification_date',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'certification_date,allow_listing,certificate_type,',
        'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Certificate.php',
        'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_certifications_domain_model_certificate.gif'
    ],
];

t3lib_extMgm::addLLrefForTCAdescr('tx_certifications_domain_model_certificatetype', 'EXT:certifications/Resources/Private/Language/locallang_csh_tx_certifications_domain_model_certificatetype.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_certifications_domain_model_certificatetype');
$TCA['tx_certifications_domain_model_certificatetype'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:certifications/Resources/Private/Language/locallang_db.xml:tx_certifications_domain_model_certificatetype',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'versioningWS' => 2,
        'versioning_followPages' => TRUE,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,',
        'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/CertificateType.php',
        'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_certifications_domain_model_certificatetype.gif'
    ],
];

t3lib_extMgm::addLLrefForTCAdescr('tx_certifications_domain_model_user', 'EXT:certifications/Resources/Private/Language/locallang_csh_tx_certifications_domain_model_user.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_certifications_domain_model_user');
$TCA['tx_certifications_domain_model_user'] = [
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
        'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/User.php',
        'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_certifications_domain_model_user.gif'
    ],
];

?>