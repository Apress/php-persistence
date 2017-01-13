<?php
namespace Entity;

/**
 * @Entity
 * @Table(name="contact_data")
 */
class ContactData
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string", nullable=true) */
    private $email;

    /** @Column(type="string", nullable=true) */
    private $phone;

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }
}
