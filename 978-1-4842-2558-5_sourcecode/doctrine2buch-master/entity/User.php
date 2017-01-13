<?php
namespace Entity;

class User
{
    private $id;
    private $firstName;
    private $lastName;
    private $gender;
    private $namePrefix;
    private $posts = null;
    private $postRepository;

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;

    const GENDER_MALE_DISPLAY_VALUE = "Mr.";
    const GENDER_FEMALE_DISPLAY_VALUE = "Mrs.";

    public function setPostRepository($postsRepository)
    {
        $this->postRepository = $postsRepository;
    }

    public function getPostRepository()
    {
        return $this->postRepository;
    }

    public function getPosts()
    {
        if (is_null($this->posts)) {
            $this->posts = $this->postRepository->findByUser($this);
        }

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
}
