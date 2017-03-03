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
class Tx_Certifications_Controller_FeUsersController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * feUsersRepository
	 *
	 * @var Tx_Certifications_Domain_Repository_UserRepository
	 */
	protected $userRepository;

    /**
     * action list
     *
     * @param string $sorting
     * @return void
     */
    public function listAction($sorting = NULL) {
        if ($sorting == NULL || $sorting == 'asc') {
            $sort = 'desc';
            $sorto = 'asc';
        } else {
            $sort = 'asc';
            $sorto = 'desc';
        }

        //ASCII => A-Z
        if (is_null($sorting) || $sorting === 'asc') {
            for ($i = 65;  $i <= 90; $i++) {
                $feUserss[chr($i)] = $this->userRepository->findByFirstLetterOfLastName(chr($i));
            }
        } elseif ($sorting === 'desc') {
            for ($i = 90;  $i >= 65; $i--) {
                $feUserss[chr($i)] = $this->userRepository->findByFirstLetterOfLastName(chr($i));
            }
        }
        $this->view->assign('sort', $sort);
        $this->view->assign('sorto', $sorto);
 		$this->view->assign('feUserss', $feUserss);
	}

    /**
     * @param string $sortby
     * @param string $sorting
     */
    public function listSortedAction($sortby = NULL, $sorting = NULL) {
        if ($sorting == NULL || $sorting == 'asc') {
            $sort = 'desc';
            $sorto = 'asc';
        } else {
            $sort = 'asc';
            $sorto = 'desc';
        }

        $feUserss = $this->userRepository->findBySortBy($sortby,$sorting);

        $this->view->assign('sort', $sort);
        $this->view->assign('sorto', $sorto);
        $this->view->assign('feUserss', $feUserss);
    }

	/**
	 * action show
	 *
	 * @param Tx_Certifications_Domain_Model_User $user
	 * @return void
	 */
	public function showAction(Tx_Certifications_Domain_Model_User $user) {
		$this->view->assign('feUsers', $user);
	}

	/**
	 * injectFeUsersRepository
	 *
	 * @param Tx_Certifications_Domain_Repository_UserRepository $userRepository
	 * @return void
	 */
	public function injectFeUsersRepository(Tx_Certifications_Domain_Repository_UserRepository $userRepository) {
		$this->userRepository = $userRepository;
	}

}
?>