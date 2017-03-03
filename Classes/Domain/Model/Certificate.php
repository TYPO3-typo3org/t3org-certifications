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

class Tx_Certifications_Domain_Model_Certificate extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * certificationDate
	 *
	 * @var DateTime
	 * @validate NotEmpty
	 */
	protected $certificationDate;

    /**
     * expirationDate
     *
     * @var DateTime
     */
    protected $expirationDate;

	/**
	 * allowListing
	 *
	 * @var boolean
	 */
	protected $allowListing = TRUE;

	/**
 	 * true for all certifications for 4.x
	 *
	 * @var boolean
	 */
	protected $versionFour = FALSE;

	/**
	 * certificateType
	 *
	 * @var Tx_Certifications_Domain_Model_CertificateType
	 */
	protected $certificateType;

	/**
	 * Returns the certificationDate
	 *
	 * @return DateTime $certificationDate
	 */
	public function getCertificationDate() {
		return $this->certificationDate;
	}

	/**
	 * Sets the certificationDate
	 *
	 * @param DateTime $certificationDate
	 * @return void
	 */
	public function setCertificationDate($certificationDate) {
		$this->certificationDate = $certificationDate;
	}

    /**
     * Returns the expirationDate
     *
     * @return DateTime $expirationDate
     */
    public function getExpirationDate() {
        return $this->expirationDate;
    }

    /**
     * Sets the expirationDate
     *
     * @param DateTime $expirationDate
     * @return void
     */
     public function setExpirationDate($expirationDate) {
        $this->expirationDate = $expirationDate;
     }

	/**
	 * Returns the allowListing
	 *
	 * @return boolean $allowListing
	 */
	public function getAllowListing() {
		return $this->allowListing;
	}

	/**
	 * Sets the allowListing
	 *
	 * @param boolean $allowListing
	 * @return void
	 */
	public function setAllowListing($allowListing) {
		$this->allowListing = $allowListing;
	}

	/**
	 * Returns the boolean state of allowListing
	 *
	 * @return boolean
	 */
	public function isAllowListing() {
		return $this->getAllowListing();
	}

	/**
	 * Returns the version_four
	 *
	 * @return boolean $version_four
	 */
	public function getVersionFour() {
		return $this->versionFour;
	}

	/**
	 * Sets the version_four
	 *
	 * @param boolean $version_four
	 * @return void
	 */
	public function setVersionFour($versionFour) {
		$this->versionFour = $versionFour;
	}

	/**
	 * Returns the boolean state of version_four
	 *
	 * @return boolean
	 */
	public function isVersionFour() {
		return $this->getVersionFour();
	}

	/**
	 * Returns the certificateType
	 *
	 * @return Tx_Certifications_Domain_Model_CertificateType $certificateType
	 */
	public function getCertificateType() {
		return $this->certificateType;
	}

	/**
	 * Sets the certificateType
	 *
	 * @param Tx_Certifications_Domain_Model_CertificateType $certificateType
	 * @return void
	 */
	public function setCertificateType(Tx_Certifications_Domain_Model_CertificateType $certificateType) {
		$this->certificateType = $certificateType;
	}

}
?>