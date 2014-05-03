<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Ole Hartwig <o.hartwig@web-vision.de>, web-vision gmbh
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package certifications
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Certifications_Domain_Model_User extends Tx_Extbase_DomainObject_AbstractEntity {


	/**
	 * @var string
	 */
	protected $firstName;

	/**
	 * @var string
	 */
	protected $middleName;

	/**
	 * @var string
	 */
	protected $lastName;

	/**
	 * @var string
	 */
	protected $country = '';

	/**
	 * certReason
	 *
	 * @var string
	 */
	protected $certReason;

	/**
	 * publicEmailAddress
	 *
	 * @var boolean
	 */
	protected $publicEmailAddress = FALSE;

	/**
	 * certificates
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Certifications_Domain_Model_Certificate>
	 * @lazy
	 */
	protected $certificates;

	/**
	 * feUser
	 *
	 * @var Tx_T3oAjaxlogin_Domain_Model_User
	 */
	protected $feUser;

    /**
     * twitter
     *
     * @var string
     */
    protected $twitter;

    /**
     * publicTwitter
     *
     * @var boolean
     */
    protected $publicTwitter;

	/**
	 * @param string $country
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @param string $middleName
	 */
	public function setMiddleName($middleName) {
		$this->middleName = $middleName;
	}

	/**
	 * @return string
	 */
	public function getMiddleName() {
		return $this->middleName;
	}


	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->certificates = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Adds a Certificate
	 *
	 * @param Tx_Certifications_Domain_Model_Certificate $certificate
	 * @return void
	 */
	public function addCertificate(Tx_Certifications_Domain_Model_Certificate $certificate) {
		$this->certificates->attach($certificate);
	}

	/**
	 * Removes a Certificate
	 *
	 * @param Tx_Certifications_Domain_Model_Certificate $certificateToRemove The Certificate to be removed
	 * @return void
	 */
	public function removeCertificate(Tx_Certifications_Domain_Model_Certificate $certificateToRemove) {
		$this->certificates->detach($certificateToRemove);
	}

	/**
	 * Returns the certificates
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Certifications_Domain_Model_Certificate> $certificates
	 */
	public function getCertificates() {
		return $this->certificates;
	}

	/**
	 * Sets the certificates
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Certifications_Domain_Model_Certificate> $certificates
	 * @return void
	 */
	public function setCertificates(Tx_Extbase_Persistence_ObjectStorage $certificates) {
		$this->certificates = $certificates;
	}

	/**
	 * getFeUser
	 * Returns the linked frontend user
	 *
	 * @return Tx_T3oAjaxlogin_Domain_Model_User $feUser
	 */
	public function getFeUser() {
		return $this->feUser;
	}

	/**
	 * setFeUser
	 * Sets the frontend user
	 *
	 * @param Tx_T3oAjaxlogin_Domain_Model_User $feUser
	 * @return void
	 */
	public function setFeUser($feUser) {
		$this->feUser = $feUser;
	}

	/**
	 * Returns the certReason
	 *
	 * @return string $certReason
	 */
	public function getCertReason() {
		return $this->certReason;
	}

	/**
	 * Sets the certReason
	 *
	 * @param string $certReason
	 * @return void
	 */
	public function setCertReason($certReason) {
		$this->certReason = $certReason;
	}

	/**
	 * Returns the publicEmailAddress
	 *
	 * @return boolean $publicEmailAddress
	 */
	public function getPublicEmailAddress() {
		return $this->publicEmailAddress;
	}

	/**
	 * Sets the publicEmailAddress
	 *
	 * @param boolean $publicEmailAddress
	 * @return void
	 */
	public function setPublicEmailAddress($publicEmailAddress) {
		$this->publicEmailAddress = $publicEmailAddress;
	}

	/**
	 * Returns the boolean state of publicEmailAddress
	 *
	 * @return boolean
	 */
	public function isPublicEmailAddress() {
		return $this->getPublicEmailAddress();
	}

	/**
	 * isPublicInformationAvailable
	 * Returns TRUE if there is at least either a public
	 * email adress or a public twitter handle
	 *
	 * @return void
	 */
	public function isPublicInformationAvailable() {
		return ($this->isPublicEmailAddress() && $this->getEmail())
			|| ($this->isPublicTwitter() && $this->getTwitter());
	}

	/**
	 * @param boolean $publicTwitter
	 */
	public function setPublicTwitter($publicTwitter) {
		$this->publicTwitter = $publicTwitter;
	}

	/**
	 * @return boolean
	 */
	public function getPublicTwitter() {
		return $this->publicTwitter;
	}

	/**
	 * isPublicTwitter
	 * Return the boolean state of publicTwitter
	 *
	 * @return void
	 */
	public function isPublicTwitter() {
		return $this->getPublicTwitter();
	}

	/**
	 * @param string $twitter
	 */
	public function setTwitter($twitter) {
		$this->twitter = $twitter;
	}

	/**
	 * @return string
	 */
	public function getTwitter() {
		return $this->twitter;
	}
}
?>