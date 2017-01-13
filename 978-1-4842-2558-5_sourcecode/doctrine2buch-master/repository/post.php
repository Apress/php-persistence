<?php
namespace Repository;

include_once('../entity/Post.php');
include_once('../mapper/Post.php');

use Mapper\Post as PostMapper;
use Entity\Post as PostEntity;

class Post
{
    private $em;
    private $mapper;

    public function __construct($em)
    {
        $this->mapper = new PostMapper;
        $this->em = $em;
    }

    public function findByUser($user)
    {
        $postsData = $this->em
            ->query('SELECT * FROM posts WHERE user_id = ' . $user->getId())->fetchAll();

        $posts = array();

        foreach($postsData as $postData)
        {
            $newPost = new PostEntity();
            $posts[] = $this->mapper->populate($postData, $newPost);
        }

        return $posts;
    }
}
