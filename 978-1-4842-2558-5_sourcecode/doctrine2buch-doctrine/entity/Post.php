<?php
namespace Entity;

/**
 * @Entity
 * @Table(name="posts")
 */
class Post
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Entity\User", inversedBy="posts")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /** @Column(type="string") */
    private $title;

    /** @Column(type="string") */
    private $content;

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }



}
