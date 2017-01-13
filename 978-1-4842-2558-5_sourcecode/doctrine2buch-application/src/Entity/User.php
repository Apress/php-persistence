<?php
namespace Entity;

/**
 * @Entity
 * @HasLifecycleCallbacks
 * @Table(name="users")
 */
class User
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="string", name="first_name", nullable=true) */
    private $firstName;

    /** @Column(type="string", name="last_name", nullable=true) */
    private $lastName;

    /** @Column(type="integer", nullable=true) */
    private $gender;

    /** @Column(type="string", name="name_prefix", nullable=true) */
    private $namePrefix;

    /** @Column(type="string", nullable=true) */
    private $username;

    /** @Column(type="string", nullable=true) */
    private $password;

    /**
     * @OneToMany(targetEntity="Entity\Post", mappedBy="user")
     * @OrderBy({"id" = "DESC"})
     */
    private $posts;


    /**
     * @ManyToMany(targetEntity="Entity\Category")
     * @JoinTable(name="users_categories",
     *      joinColumns={@JoinColumn(name="user", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="category", referencedColumnName="id", unique=true)}
     * )
     */
    private $categories;

    /**
     * @ManyToMany(targetEntity="Entity\Role")
     * @JoinTable(name="users_roles",
     *      joinColumns={@JoinColumn(name="user", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="role", referencedColumnName="id")}
     * )
     */
    private $roles;

    /**
     * @OneToOne(targetEntity="Entity\ContactData")
     */
    private $contactData;

    /**
     * @OneToOne(targetEntity="Entity\UserInfo", inversedBy="user")
     */
    private $userInfo;

    /**
     * @OneToOne(targetEntity="Entity\User")
     **/
    private $lifePartner;

    /**
    * @ManyToMany(targetEntity="Entity\User")
    * @JoinTable(name="friends",
    *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
    *      inverseJoinColumns={@JoinColumn(name="friend_user_id", referencedColumnName="id")}
    *      )
    **/
    private $myFriends;

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;

    const GENDER_MALE_DISPLAY_VALUE = "Mr.";
    const GENDER_FEMALE_DISPLAY_VALUE = "Mrs.";

    const GENERATED_PASSWORD_LENGTH = 6;

    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myFriends = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function removeUserInfo()
    {
        $this->userInfo->setUser(null);
        $this->userInfo = null;
    }

    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    public function getPosts()
    {
        return $this->posts;
    }

    public function assembleDisplayName()
    {
        $displayName = '';

        if ($this->gender == self::GENDER_MALE) {
            $displayName .= self::GENDER_MALE_DISPLAY_VALUE;
        } elseif ($this->gender == self::GENDER_FEMALE) {
            $displayName .= self::GENDER_FEMALE_DISPLAY_VALUE;
        }

        if ($this->namePrefix) {
            $displayName .= ' ' . $this->namePrefix;
        }

        $displayName .= ' ' . $this->firstName . ' ' . $this->lastName;

        return $displayName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setNamePrefix($namePrefix)
    {
        $this->namePrefix = $namePrefix;
    }

    public function getNamePrefix()
    {
        return $this->namePrefix;
    }

    public function setContactData($contactData)
    {
        $this->contactData = $contactData;
    }

    public function getContactData()
    {
        return $this->contactData;
    }

    public function setUserInfo($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    public function getUserInfo()
    {
        return $this->userInfo;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setLifePartner($lifePartner)
    {
        $this->lifePartner = $lifePartner;
    }

    public function getLifePartner()
    {
        return $this->lifePartner;
    }

    public function setMyFriends($myFriends)
    {
        $this->myFriends = $myFriends;
    }

    public function getMyFriends()
    {
        return $this->myFriends;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /** @PrePersist */
    public function generatePassword()
    {
        for($i = 1; $i <= self::GENERATED_PASSWORD_LENGTH; $i++) {
            $this->password .= chr(rand(65, 90)); // 65 -> A, 90 -> Z
        }
    }
}
