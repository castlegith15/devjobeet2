<?php

namespace Pr1\JobeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Pr1\JobeetBundle\Utils\Jobeet as Jobeet;

/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $affiliate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $job;
    
    private $active_jobs;

    private $more_jobs;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->affiliate = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
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
     * Add affiliate
     *
     * @param \Pr1\JobeetBundle\Entity\Affiliate $affiliate
     * @return Category
     */
    public function addAffiliate(\Pr1\JobeetBundle\Entity\Affiliate $affiliate)
    {
        $this->affiliate[] = $affiliate;

        return $this;
    }

    /**
     * Remove affiliate
     *
     * @param \Pr1\JobeetBundle\Entity\Affiliate $affiliate
     */
    public function removeAffiliate(\Pr1\JobeetBundle\Entity\Affiliate $affiliate)
    {
        $this->affiliate->removeElement($affiliate);
    }

    /**
     * Get affiliate
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAffiliate()
    {
        return $this->affiliate;
    }
    
    /**
     * Add job
     *
     * @param \Pr1\JobeetBundle\Entity\Job $job
     *
     * @return Category
     */
    public function addJob(\Pr1\JobeetBundle\Entity\Job $job)
    {
        $this->job[] = $job;

        return $this;
    }

    /**
     * Remove job
     *
     * @param \Pr1\JobeetBundle\Entity\Job $job
     */
    public function removeJob(\Pr1\JobeetBundle\Entity\Job $job)
    {
        $this->job->removeElement($job);
    }

    /**
     * Get job
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJob()
    {
        return $this->job;
    }



    /**
     * @ORM\PrePersist
     */
    public function setSlugValue()
    {
        $this->slug = Jobeet::slugify($this->getName());
    }

    public function __toString()
    {
        return $this->getName() ? $this->getName() : "";
    } 


    public function setActiveJobs($jobs)
    {
        $this->active_jobs = $jobs;
    }
 
    public function getActiveJobs()
    {
        return $this->active_jobs;
    }

    public function setMoreJobs($jobs)
    {
        $this->more_jobs = $jobs >=  0 ? $jobs : 0;
    }
 
    public function getMoreJobs()
    {
        return $this->more_jobs;
    }
}
