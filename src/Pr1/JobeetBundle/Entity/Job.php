<?php

namespace Pr1\JobeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use  \Pr1\JobeetBundle\Utils\Jobeet as Jobeet;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Job
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Pr1\JobeetBundle\Entity\JobRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Job
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255 , nullable=true)
     *
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getTypeValues")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255 , nullable=true)
     */
    private $logo;
    
    /**
     * @Assert\File(
     *     maxSize="5M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/jpg", "image/gif"}
     * )
     * @Vich\UploadableField(mapping="job_logo", fileNameProperty="logo")
     *
     * @var File $logo_virtual
     *
     * This is the virtual field that will populate logo with the resulting file.
     */
    protected $logo_virtual;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255 , nullable=true)
     *
     * @Assert\Url()
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     *
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="how_to_apply", type="text")
     *
     * @Assert\NotBlank()
     */
    private $how_to_apply;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255 , unique=true)
     */
    private $token;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_public", type="boolean" , nullable=true)
     */
    private $is_public;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_activated", type="boolean" , nullable=true)
     */
    private $is_activated;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires_at", type="datetime")
     */
    private $expires_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime" , nullable=true) 
     */
    private $updated_at;

     /**
      * @ORM\ManyToOne(targetEntity="Category", inversedBy="jobs")
      * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
      **/
    private $category;

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
     * Set type
     *
     * @param string $type
     *
     * @return Job
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Job
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    public function setLogoVirtual(File $image = null)
    {
        $this->logo_virtual = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated_at = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getLogoVirtual()
    {
        return $this->logo_virtual;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Job
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Job
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set position
     *
     * @param string $position
     *
     * @return Job
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Job
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set howToApply
     *
     * @param string $howToApply
     *
     * @return Job
     */
    public function setHowToApply($howToApply)
    {
        $this->how_to_apply = $howToApply;

        return $this;
    }

    /**
     * Get howToApply
     *
     * @return string
     */
    public function getHowToApply()
    {
        return $this->how_to_apply;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Job
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     *
     * @return Job
     */
    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;

        return $this;
    }

    /**
     * Get isPublic
     *
     * @return boolean
     */
    public function getIsPublic()
    {
        return $this->is_public;
    }

    /**
     * Set isActivated
     *
     * @param boolean $isActivated
     *
     * @return Job
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;

        return $this;
    }

    /**
     * Get isActivated
     *
     * @return boolean
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Job
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     *
     * @return Job
     */
    public function setExpiresAt($expiresAt)
    {
        $this->expires_at = $expiresAt;

        return $this;
    }

    /**
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Job
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Job
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set category
     *
     * @param \Pr1\JobeetBundle\Entity\Category $category
     *
     * @return Job
     */
    public function setCategory(\Pr1\JobeetBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Pr1\JobeetBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }


    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt()) {
            $this->created_at = new DateTime();
        }
    }
 
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updated_at = new DateTime();
    }

     /**
     * @ORM\PrePersist
     */
    public function setExpiresAtValue()
    {
        if(!$this->getExpiresAt()) {
            $now = $this->getCreatedAt() ? $this->getCreatedAt()->format('U') :
time();
            $this->expires_at = new DateTime(date('Y-m-d H:i:s', $now + 86400 * 90));
        }
    }

    public function getCompanySlug()
    {
        return Jobeet::slugify($this->getCompany());
    }

    public function getPositionSlug()
    {
        return Jobeet::slugify($this->getPosition());
    }

    public function getLocationSlug()
    {
        return Jobeet::slugify($this->getLocation());
    }

    public static function getTypes()
    {
        return array('full-time' => 'Full time', 'part-time' => 'Part time', 'fr
eelance' => 'Freelance');
    }

    public static function getTypeValues()
    {
        return array_keys(self::getTypes());
    }

    /**
     * @ORM\PrePersist
     */
    public function setTokenValue()
    {
        if(!$this->getToken()) {
            $this->token = sha1($this->getEmail().rand(11111, 99999));
        }
    }

    public function isExpired()
    {
        return $this->getDaysBeforeExpires() < 0;
    }

    public function expiresSoon()
    {
        return $this->getDaysBeforeExpires() < 5;
    }

    public function getDaysBeforeExpires()
    {
        return ceil(($this->getExpiresAt()->format('U') - time()) / 86400);
    }

    public function publish()
    {
        $this->setIsActivated(true);
    }

   public function extend()
   {
    if (!$this->expiresSoon())
    {
        return false;
    }

    $this->expires_at = new DateTime(date('Y-m-d H:i:s', time() + 86400 * 90));

    return true;
    }

    public function getWebPath()
    {
        $webPath = "/uploads/jobs/".$this->logo;
        return $webPath ;
    }

}
