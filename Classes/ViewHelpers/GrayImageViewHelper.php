<?php
namespace T3o\Certifications\ViewHelpers;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\CommandUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Exception;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

/**
 * Resizes a given image (if required) and renders the respective img tag
 *
 * = Examples =
 *
 * <code title="Default">
 * <f:image src="EXT:myext/Resources/Public/typo3_logo.png" alt="alt text" />
 * </code>
 * <output>
 * <img alt="alt text" src="typo3conf/ext/myext/Resources/Public/typo3_logo.png" width="396" height="375" />
 * or (in BE mode):
 * <img alt="alt text" src="../typo3conf/ext/viewhelpertest/Resources/Public/typo3_logo.png" width="396" height="375" />
 * </output>
 *
 * <code title="Inline notation">
 * {f:image(src: 'EXT:viewhelpertest/Resources/Public/typo3_logo.png', alt: 'alt text', minWidth: 30, maxWidth: 40)}
 * </code>
 * <output>
 * <img alt="alt text" src="../typo3temp/pics/f13d79a526.png" width="40" height="38" />
 * (depending on your TYPO3s encryption key)
 * </output>
 *
 * <code title="non existing image">
 * <f:image src="NonExistingImage.png" alt="foo" />
 * </code>
 * <output>
 * Could not get image resource for "NonExistingImage.png".
 * </output>
 */
class GrayImageViewHelper extends AbstractTagBasedViewHelper
{

    /**
     * @var ContentObjectRenderer
     */
    protected $contentObject;

    /**
     * @var string
     */
    protected $tagName = 'img';

    /**
     * @var TypoScriptFrontendController contains a backup of the current $GLOBALS['TSFE'] if used in BE mode
     */
    protected $tsfeBackup;

    /**
     * @var string
     */
    protected $workingDirectoryBackup;

    /**
     * @var ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * @param ConfigurationManagerInterface $configurationManager
     * @return void
     */
    public function injectConfigurationManager(ConfigurationManagerInterface $configurationManager)
    {
        $this->configurationManager = $configurationManager;
        $this->contentObject = $this->configurationManager->getContentObject();
    }

    /**
     * Initialize arguments.
     *
     * @return void
     * @author Bastian Waidelich <bastian@typo3.org>
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('alt', 'string', 'Specifies an alternate text for an image', TRUE);
        $this->registerTagAttribute('ismap', 'string', 'Specifies an image as a server-side image-map. Rarely used. Look at usemap instead', FALSE);
        $this->registerTagAttribute('longdesc', 'string', 'Specifies the URL to a document that contains a long description of an image', FALSE);
        $this->registerTagAttribute('usemap', 'string', 'Specifies an image as a client-side image-map', FALSE);
    }

    /**
     * Resizes a given image (if required) and renders the respective img tag
     * @see http://typo3.org/documentation/document-library/references/doc_core_tsref/4.2.0/view/1/5/#id4164427
     *
     * @param string $src
     * @param string $width width of the image. This can be a numeric value representing the fixed width of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param string $height height of the image. This can be a numeric value representing the fixed height of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param integer $minWidth minimum width of the image
     * @param integer $minHeight minimum height of the image
     * @param integer $maxWidth maximum width of the image
     * @param integer $maxHeight maximum height of the image
     *
     * @return string rendered tag.
     * @author Sebastian Böttger <sboettger@cross-content.com>
     * @author Bastian Waidelich <bastian@typo3.org>
     */
    public function render($src, $width = NULL, $height = NULL, $minWidth = NULL, $minHeight = NULL, $maxWidth = NULL, $maxHeight = NULL)
    {
        if (TYPO3_MODE === 'BE') {
            $this->simulateFrontendEnvironment();
        }
        $setup = [
            'width' => $width,
            'height' => $height,
            'minW' => $minWidth,
            'minH' => $minHeight,
            'maxW' => $maxWidth,
            'maxH' => $maxHeight
        ];
        if (TYPO3_MODE === 'BE' && substr($src, 0, 3) === '../') {
            $src = substr($src, 3);
        }
        $imageInfo = $this->contentObject->getImgResource($src, $setup);
        $GLOBALS['TSFE']->lastImageInfo = $imageInfo;
        if (!is_array($imageInfo)) {
            if (TYPO3_MODE === 'BE') {
                $this->resetFrontendEnvironment();
            }
            throw new Exception('Could not get image resource for "' . htmlspecialchars($src) . '".', 1253191060);
        }
        $imageInfo[3] = GeneralUtility::png_to_gif_by_imagemagick($imageInfo[3]);

        //Convert to grey
        $newFile = substr($imageInfo[3], 0, -4) . '.jpg';
        $cmd = GeneralUtility::imageMagickCommand('convert', '"' . $imageInfo[3] . '" -colorspace Gray "' . $newFile . '"', $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path_lzw']);
        CommandUtility::exec($cmd);
        $imageInfo[3] = $newFile;
        if (@is_file($newFile)) {
            GeneralUtility::fixPermissions($newFile);
        }

        $GLOBALS['TSFE']->imagesOnPage[] = $imageInfo[3];

        $imageSource = $GLOBALS['TSFE']->absRefPrefix . GeneralUtility::rawUrlEncodeFP($imageInfo[3]);
        if (TYPO3_MODE === 'BE') {
            $imageSource = '../' . $imageSource;
            $this->resetFrontendEnvironment();
        }
        $this->tag->addAttribute('src', $imageSource);
        $this->tag->addAttribute('width', $imageInfo[0]);
        $this->tag->addAttribute('height', $imageInfo[1]);
        //the alt-attribute is mandatory to have valid html-code, therefore add it even if it is empty
        if (empty($this->arguments['alt'])) {
            $this->tag->addAttribute('alt', '');
        }
        if (empty($this->arguments['title']) && !empty($this->arguments['alt'])) {
            $this->tag->addAttribute('title', $this->arguments['alt']);
        }

        return $this->tag->render();
    }

    /**
     * Prepares $GLOBALS['TSFE'] for Backend mode
     * This somewhat hacky work around is currently needed because the getImgResource() function of tslib_cObj relies on those variables to be set
     *
     * @return void
     * @author Bastian Waidelich <bastian@typo3.org>
     */
    protected function simulateFrontendEnvironment()
    {
        $this->tsfeBackup = isset($GLOBALS['TSFE']) ? $GLOBALS['TSFE'] : NULL;
        // set the working directory to the site root
        $this->workingDirectoryBackup = getcwd();
        chdir(PATH_site);

        $typoScriptSetup = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $GLOBALS['TSFE'] = new \stdClass();
        $template = GeneralUtility::makeInstance('t3lib_TStemplate');
        $template->tt_track = 0;
        $template->init();
        $template->getFileName_backPath = PATH_site;
        $GLOBALS['TSFE']->tmpl = $template;
        $GLOBALS['TSFE']->tmpl->setup = $typoScriptSetup;
        $GLOBALS['TSFE']->config = $typoScriptSetup;
    }

    /**
     * Resets $GLOBALS['TSFE'] if it was previously changed by simulateFrontendEnvironment()
     *
     * @return void
     * @author Bastian Waidelich <bastian@typo3.org>
     * @see simulateFrontendEnvironment()
     */
    protected function resetFrontendEnvironment()
    {
        $GLOBALS['TSFE'] = $this->tsfeBackup;
        chdir($this->workingDirectoryBackup);
    }
}