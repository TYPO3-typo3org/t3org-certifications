<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'T3o.' . $_EXTKEY,
    'Certlist',
    'Certification List'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Certifications');

$TCA['tt_content']['types']['list']['subtypes_addlist']['certifications_certlist'] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('certifications_certlist', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Certlist.xml');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_certifications_domain_model_certificate', 'EXT:certifications/Resources/Private/Language/locallang_csh_tx_certifications_domain_model_certificate.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_certifications_domain_model_certificate');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_certifications_domain_model_certificatetype', 'EXT:certifications/Resources/Private/Language/locallang_csh_tx_certifications_domain_model_certificatetype.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_certifications_domain_model_certificatetype');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_certifications_domain_model_user', 'EXT:certifications/Resources/Private/Language/locallang_csh_tx_certifications_domain_model_user.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_certifications_domain_model_user');

?>