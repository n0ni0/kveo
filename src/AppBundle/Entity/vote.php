<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table(name="vote")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VoteRepository")
 */
class Vote
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\media")
     * @ORM\JoinColumn(name="media_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\voteType")
     * @ORM\JoinColumn(name="voteType_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $voteType;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set media
     *
     * @param \AppBundle\Entity\media $media
     *
     * @return vote
     */
    public function setMedia(\AppBundle\Entity\media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \AppBundle\Entity\media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\user $user
     *
     * @return vote
     */
    public function setUser(\AppBundle\Entity\user $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set voteType
     *
     * @param \AppBundle\Entity\voteType $voteType
     *
     * @return vote
     */
    public function setVoteType(\AppBundle\Entity\voteType $voteType = null)
    {
        $this->voteType = $voteType;

        return $this;
    }

    /**
     * Get voteType
     *
     * @return \AppBundle\Entity\voteType
     */
    public function getVoteType()
    {
        return $this->voteType;
    }
}
