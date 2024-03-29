<?php

namespace AppBundle\Repository;

/**
 * AppBankRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AppBankRepository extends \Doctrine\ORM\EntityRepository
{
    public function findBankIn($fields)
    {
       return $this->createQueryBuilder('b')
                ->where('b.id in(:ids)')
                ->setParameter('ids', array_values($fields))
                ->getQuery()
                ->getResult(); 
    }
}
