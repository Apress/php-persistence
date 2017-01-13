<?php
namespace Entity;

/**
 * @Entity
 * @Table(name="user_info")
 */
class UserInfo
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="datetime", nullable=true) */
    private $signUpDate;

    /** @Column(type="datetime", nullable=true) */
    private $signOffDate = null;

    /**
     * @OneToOne(targetEntity="Entity\User", mappedBy="userInfo")
     */
    private $user;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSignOffDate($signOffDate)
    {
        $this->signOffDate = $signOffDate;
    }

    public function getSignOffDate()
    {
        return $this->signOffDate;
    }

    public function setSignUpDate($signUpDate)
    {
        $this->signUpDate = $signUpDate;
    }

    public function getSignUpDate()
    {
        return $this->signUpDate;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }


}
