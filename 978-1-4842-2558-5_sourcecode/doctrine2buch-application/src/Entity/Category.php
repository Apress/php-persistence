<?php
namespace Entity;

/**
 * @Entity
 * @Table(name="category")
 */
class Category
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string") */
    private $label;

    /**
     * @OneToMany(targetEntity="Entity\Category", mappedBy="parent")
     **/
    private $children;

    /**
     * @ManyToOne(targetEntity="Entity\Category", inversedBy="children")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    private $parent;

    public function __construct() {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setChildren($children)
    {
        $this->children = $children;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

}
