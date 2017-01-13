<?php
namespace Repository;

use Doctrine\ORM\EntityRepository;

class Post extends EntityRepository
{
    public function findAllPostsWithTag($tag)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('partial u.{id, firstName}')
            ->from('Entity\User', 'u')
            ->where($qb->expr()->eq('u.lastName', '?1'))
            ->setParameter(1, "Mustermann");

        $users = $qb->getQuery()->getResult();

        //var_dump($users);exit;
    }
}