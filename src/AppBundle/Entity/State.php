<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * State
 *
 * @ORM\Table(name="state")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StateRepository")
 */
class State
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *@ORM\ManyToOne(targetEntity="AppBundle\Entity\Media")
     *@ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MediaState")
     * @ORM\JoinColumn(name="mediaState_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $mediaState;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set media
     *
     * @param string $media
     *
     * @return state
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return state
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set mediaState
     *
     * @param \AppBundle\Entity\mediaState $mediaState
     *
     * @return state
     */
    public function setMediaState(\AppBundle\Entity\MediaState $mediaState = null)
    {
        $this->mediaState = $mediaState;

        return $this;
    }

    /**
     * Get mediaState
     *
     * @return \AppBundle\Entity\mediaState
     */
    public function getMediaState()
    {
        return $this->mediaState;
    }
}
