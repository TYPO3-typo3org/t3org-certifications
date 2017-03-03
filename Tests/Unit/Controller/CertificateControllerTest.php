<?php

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
class Tx_Certifications_Controller_CertificateControllerTest extends Tx_Extbase_Tests_Unit_BaseTestCase
{
    /**
     * @var Tx_Certifications_Domain_Model_Certificate
     */
    protected $fixture;

    public function setUp()
    {
        $this->fixture = new Tx_Certifications_Domain_Model_Certificate();
    }

    public function tearDown()
    {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function dummyMethod()
    {
        $this->markTestIncomplete();
    }

}

?>