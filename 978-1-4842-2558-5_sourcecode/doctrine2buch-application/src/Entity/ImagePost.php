<?php
namespace Entity;

/**
 * @Entity
 * @Table(name="posts_image")
 */
class ImagePost extends Post
{
    /** @Column(type="string") */
    private $imageUrl;

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

}
