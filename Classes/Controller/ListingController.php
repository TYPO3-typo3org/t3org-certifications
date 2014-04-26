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
class Tx_Certifications_Controller_ListingController extends Tx_Extbase_MVC_Controller_ActionController {

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
    public function listAction() {
//        if ($sorting == NULL || $sorting == 'asc') {
//            $sort = 'desc';
//            $sorto = 'asc';
//        } else {
//            $sort = 'asc';
//            $sorto = 'desc';
//        }

		/**
		 * an array with the letters 'A' to 'Z' and '#' as keys and empty arrays as value
		 * @var array
		*/
		$feUserss = array_combine(range('A', 'Z'), array_fill(0,26,array()));
//		if($sorting === 'desc') {
//			$feUserss = array_reverse($feUserss);
//		}
		$feUserss['#'] = array();
		// add all users according to the first letter of their last name
		foreach($this->userRepository->findAll() as $user) {
			/** @var Tx_Certifications_Domain_Model_User $user */
			$firstLetter = strtoupper(substr($user->getLastName(), 0, 1));
			if(array_key_exists($firstLetter, $feUserss)) {
				$feUserss[$firstLetter][] = $user;
			} else {
				$feUserss['#'][] = $user;
			}
		}
		if(empty($feUserss['#'])) {
			unset($feUserss['#']);
		}

//        $this->view->assign('sort', $sort);
//        $this->view->assign('sorto', $sorto);
 		$this->view->assign('feUserss', $feUserss);
	}

    /**
     * @param string $sortby
     * @param string $sorting
     */
//    public function listSortedAction($sortby = NULL, $sorting = NULL) {
//        if ($sorting == NULL || $sorting == 'asc') {
//            $sort = 'desc';
//            $sorto = 'asc';
//        } else {
//            $sort = 'asc';
//            $sorto = 'desc';
//        }
//
//        $feUserss = $this->userRepository->findBySortBy($sortby,$sorting);
//
//        $this->view->assign('sort', $sort);
//        $this->view->assign('sorto', $sorto);
//        $this->view->assign('feUserss', $feUserss);
//    }

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