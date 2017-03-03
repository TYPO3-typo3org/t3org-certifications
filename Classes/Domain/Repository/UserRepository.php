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
class Tx_Certifications_Domain_Repository_UserRepository extends Tx_Extbase_Persistence_Repository
{

    /**
     * @return array|Tx_Extbase_Persistence_QueryResultInterface
     */
    public function findAll()
    {
        $query = $this->createQuery();
        $query->setOrderings([
            'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
            'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
            'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
        ]);
        $return = $query->execute();
        return $return;
    }

    /**
     * findByFistChar
     *
     * @param string $char
     * @return Tx_Extbase_Query_Result
     */
    public function findByFirstChar($char = 'A')
    {
        $char = $GLOBALS['TYPO3_DB']->escapeStrForLike($char, 'fe_users');
        $query = $this->createQuery();
        $query->setOrderings(
            [
                'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
            ]
        );
        if ($char !== '#') {
            $query->matching(
                $query->like('last_name', $char . '%')
            );
            return $query->execute();
        }

        // find all users theirs names do not begin with a letter
        $letters = range('A', 'Z');
        $constraints = [];
        foreach ($letters as $letter) {
            $constraints[] = $query->like('last_name', $letter . '%');
        }
        $query->matching(
            $query->logicalNot(
                $query->logicalOr($constraints)
            )
        );
        return $query->execute();
    }

    /**
     * @param $sortby
     * @param $sorting
     * @return array|Tx_Extbase_Persistence_QueryResultInterface
     */
    public function findBySortBy($sortby, $sorting)
    {
        $query = $this->createQuery();

        if ($sortby === 'country') {
            if ($sorting === 'asc') {
                $query->setOrderings([
                    'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'certificates' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
                ]);
            } elseif ($sorting === 'desc') {
                $query->setOrderings([
                    'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING,
                    'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'certificates' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
                ]);
            }
        } elseif ($sortby === 'certificate') {
            if ($sorting === 'asc') {
                $query->setOrderings([
                    'certificates' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
                ]);
            } elseif ($sorting === 'desc') {
                $query->setOrderings([
                    'certificates' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING,
                    'last_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'first_name' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING,
                    'country' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING
                ]);
            }
        }

        $return = $query->execute();

        return $return;
    }
}

?>