<?php
namespace T3o\Certifications\Domain\Repository;

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

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class UserRepository extends Repository
{

    /**
     * @return array|QueryResultInterface
     */
    public function findAll()
    {
        $query = $this->createQuery();
        $query->setOrderings([
            'last_name' => QueryInterface::ORDER_ASCENDING,
            'first_name' => QueryInterface::ORDER_ASCENDING,
            'country' => QueryInterface::ORDER_ASCENDING
        ]);
        $return = $query->execute();
        return $return;
    }

    /**
     * findByFistChar
     *
     * @param string $char
     * @return QueryResultInterface
     */
    public function findByFirstChar($char = 'A')
    {
        $char = $GLOBALS['TYPO3_DB']->escapeStrForLike($char, 'fe_users');
        $query = $this->createQuery();
        $query->setOrderings(
            [
                'last_name' => QueryInterface::ORDER_ASCENDING,
                'first_name' => QueryInterface::ORDER_ASCENDING
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
     * @return array|QueryResultInterface
     */
    public function findBySortBy($sortby, $sorting)
    {
        $query = $this->createQuery();

        if ($sortby === 'country') {
            if ($sorting === 'asc') {
                $query->setOrderings([
                    'country' => QueryInterface::ORDER_ASCENDING,
                    'last_name' => QueryInterface::ORDER_ASCENDING,
                    'first_name' => QueryInterface::ORDER_ASCENDING,
                    'certificates' => QueryInterface::ORDER_ASCENDING
                ]);
            } elseif ($sorting === 'desc') {
                $query->setOrderings([
                    'country' => QueryInterface::ORDER_DESCENDING,
                    'last_name' => QueryInterface::ORDER_ASCENDING,
                    'first_name' => QueryInterface::ORDER_ASCENDING,
                    'certificates' => QueryInterface::ORDER_ASCENDING
                ]);
            }
        } elseif ($sortby === 'certificate') {
            if ($sorting === 'asc') {
                $query->setOrderings([
                    'certificates' => QueryInterface::ORDER_ASCENDING,
                    'last_name' => QueryInterface::ORDER_ASCENDING,
                    'first_name' => QueryInterface::ORDER_ASCENDING,
                    'country' => QueryInterface::ORDER_ASCENDING
                ]);
            } elseif ($sorting === 'desc') {
                $query->setOrderings([
                    'certificates' => QueryInterface::ORDER_DESCENDING,
                    'last_name' => QueryInterface::ORDER_ASCENDING,
                    'first_name' => QueryInterface::ORDER_ASCENDING,
                    'country' => QueryInterface::ORDER_ASCENDING
                ]);
            }
        }

        $return = $query->execute();

        return $return;
    }
}

?>