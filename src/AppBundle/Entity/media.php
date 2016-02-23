<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MediaRepository")
 */
class Media
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\mediaType")
     */
    private $mediaType;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\gender")
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="season", type="string", length=255, nullable=true)
     */
    private $season;

    /**
     * @var string
     *
     * @ORM\Column(name="plot", type="text")
     */
    private $plot;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, unique=true)
     */
    private $img;

    /**
     * @var string
     *
     * @ORM\Column(name="trailer", type="string", length=255, nullable=true)
     */
    private $trailer;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\comment", mappedBy="media")
     */
    private $comments;

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
     * Set title
     *
     * @param string $title
     *
     * @return media
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return gender
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set year
     *
     * @param string $year
     *
     * @return media
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set season
     *
     * @param string $season
     *
     * @return media
     */
    public function setSeason($season)
    {
        $this->season = $season;

        return $this;
    }

    /**
     * Get season
     *
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set plot
     *
     * @param string $plot
     *
     * @return media
     */
    public function setPlot($plot)
    {
        $this->plot = $plot;

        return $this;
    }

    /**
     * Get plot
     *
     * @return string
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return media
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set mediaType
     *
     * @param \AppBundle\Entity\mediaType $mediaType
     *
     * @return media
     */
    public function setMediaType(\AppBundle\Entity\mediaType $mediaType = null)
    {
        $this->mediaType = $mediaType;

        return $this;
    }

    /**
     * Get mediaType
     *
     * @return \AppBundle\Entity\mediaType
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * Set gender
     *
     * @param \AppBundle\Entity\gender $gender
     *
     * @return media
     */
    public function setGender(\AppBundle\Entity\gender $gender = null)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return \AppBundle\Entity\gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set mediaTrailer
     *
     * @param \AppBundle\Entity\mediaTrailer $mediaTrailer
     *
     * @return media
     */
    public function setMediaTrailer(\AppBundle\Entity\mediaTrailer $mediaTrailer = null)
    {
        $this->mediaTrailer = $mediaTrailer;

        return $this;
    }

    /**
     * Get mediaTrailer
     *
     * @return \AppBundle\Entity\mediaTrailer
     */
    public function getMediaTrailer()
    {
        return $this->mediaTrailer;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\comment $comment
     *
     * @return media
     */
    public function addComment(\AppBundle\Entity\comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\comment $comment
     */
    public function removeComment(\AppBundle\Entity\comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set trailer
     *
     * @param string $trailer
     *
     * @return media
     */
    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;

        return $this;
    }

    /**
     * Get trailer
     *
     * @return string
     */
    public function getTrailer()
    {
        return $this->trailer;
    }
}
