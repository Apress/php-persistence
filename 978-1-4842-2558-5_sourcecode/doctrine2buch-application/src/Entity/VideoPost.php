<?php
namespace Entity;

/**
 * @Entity
 * @Table(name="posts_video")
 */
class VideoPost extends Post
{
    /** @Column(type="string") */
    private $videoUrl;

    /**
     * @param mixed $videoUrl
     */
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;
    }

    /**
     * @return mixed
     */
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }


}
