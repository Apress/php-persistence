<?php
namespace Repository;

include_once('../entity/User.php');
include_once('../mapper/User.php');

use Mapper\User as UserMapper;
use Entity\User as UserEntity;

class User
{
    private $em;
    private $mapper;

    public function __construct($em)
    {
        $this->mapper = new UserMapper;
        $this->em = $em;
    }

    public function findOneById($id)
    {
        $userData = $this->em->query('SELECT * FROM users WHERE id = ' . $id)->fetch();

        $newUser = new UserEntity();
        $newUser->setPostRepository($this->em->getPostRepository());

        return $this->em->registerUserEntity(
            $id,
            $this->mapper->populate($userData, $newUser)
        );
    }
}
