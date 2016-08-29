<?php

namespace AppBundle\Entity;


use AppBundle\Utils\Slugger;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MediaRepository")
 * @Vich\Uploadable
 * @Serializer\ExclusionPolicy("all")
 */
class Media
{
    const NUM_ITEMS = 24;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     * @Serializer\Groups({"list", "details"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MediaType")
     * @Serializer\Groups({"list", "details"})
     * @Serializer\Expose()
     */
    private $mediaType;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Gender")
     * @Serializer\Groups({"list", "details"})
     * @Serializer\Expose()
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Serializer\Groups({"list", "details"})
     * @Serializer\Expose()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose()
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="integer")
     * @Serializer\Groups({"details"})
     * @Serializer\Expose()
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="season", type="string", length=255, nullable=true)
     * @Serializer\Groups({"details"})
     * @Serializer\Expose()
     */
    private $season;

    /**
     * @var string
     *
     * @ORM\Column(name="plot", type="text")
     * @Serializer\Groups({"list", "details"})
     * @Serializer\Expose()
     */
    private $plot;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     * @Serializer\Groups({"list", "details"})
     * @Serializer\Expose()
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="media_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="trailer", type="string", length=255, nullable=true)
     * @Serializer\Groups({"list", "details"})
     * @Serializer\Expose()
     */
    private $trailer;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="media")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="Person", inversedBy="medias")
     * @JoinTable(name="medias_persons",
     *     joinColumns={@JoinColumn(name="media_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="person_id", referencedColumnName="id")}
     *     )
     * @Serializer\Groups({"details"})
     * @Serializer\Expose()
     */
    private $persons;

    public function __construct() {
        $this->persons = new ArrayCollection();
    }

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
        $this->slug = Slugger::slugify($title);

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
     * Set image
     *
     * @param string $image
     *
     * @return media
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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

    /**
     * Add person
     *
     * @param \AppBundle\Entity\Person $person
     *
     * @return Media
     */
    public function addPerson(\AppBundle\Entity\Person $person)
    {
        $this->persons->add($person);
    }

    /**
     * Remove person
     *
     * @param \AppBundle\Entity\Person $person
     */
    public function removePerson(\AppBundle\Entity\Person $person)
    {
        $person->removeMedia($this);
        $this->persons->removeElement($person);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersons()
    {
        return $this->persons;
    }

    /**
     *
     * @param Person[] $persons
     */
    public function setPersons($persons)
    {
        foreach ($this->getPersons() as $person) {
            $this->removePerson($person);
        }
        foreach ($persons as $person) {
            $this->addPerson($person);
        }
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function __toString(){
        return $this->getTitle();
    }
}
