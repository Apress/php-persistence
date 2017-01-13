<?php
namespace Entity;

/**
 * @Entity(repositoryClass="Repository\Post")
 * @Table(name="posts")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"text" = "Post", "video" = "VideoPost", "image" = "ImagePost"})
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

    /**
     * @ManyToMany(targetEntity="Entity\Tag", inversedBy="posts")
     */
    private $tags;

    /** @Column(type="string") */
    private $title;

    /** @Column(type="text") */
    private $content;

    /**
     * @ManyToOne(targetEntity="Entity\Category")
     * @JoinColumn(name="category_id", referencedColumnName="id")
     **/
    private $category;

    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }



}
