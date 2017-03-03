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
class Tx_Certifications_Controller_ListingController extends Tx_Extbase_MVC_Controller_ActionController
{

    /**
     * feUsersRepository
     *
     * @var Tx_Certifications_Domain_Repository_UserRepository
     */
    protected $userRepository;

    /**
     * listAction
     *
     * @param string $char
     * @return void
     */
    public function listAction($char = NULL)
    {
        if (empty($char)) {
            $char = 'A';
        }
        $chars = range('A', 'Z');
        array_push($chars, '#');
        $feUsers = $this->userRepository->findByFirstChar($char);
        $this->view->assignMultiple(
            [
                'feUsers' => $feUsers,
                'chars' => $chars,
                'char' => $char
            ]
        );
    }

    /**
     * action show
     *
     * @param Tx_Certifications_Domain_Model_User $user
     * @return void
     */
    public function showAction(Tx_Certifications_Domain_Model_User $user)
    {
        $this->view->assign('certUser', $user);
    }

    /**
     * injectFeUsersRepository
     *
     * @param Tx_Certifications_Domain_Repository_UserRepository $userRepository
     * @return void
     */
    public function injectFeUsersRepository(Tx_Certifications_Domain_Repository_UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

}

?>