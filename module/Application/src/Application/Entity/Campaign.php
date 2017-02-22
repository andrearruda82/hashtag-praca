<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Campaign
 *
 * @ORM\Table(name="campaign")
 * @ORM\Entity(repositoryClass="Application\Repository\CampaignRepository")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
class Campaign
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="period_start", type="datetime", nullable=false)
     */
    private $periodStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="period_final", type="datetime", nullable=false)
     */
    private $periodFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;



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
     *
     * @return Campaign
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
     * Set periodStart
     *
     * @param \DateTime $periodStart
     *
     * @return Campaign
     */
    public function setPeriodStart($periodStart)
    {
        $this->periodStart = $periodStart;

        return $this;
    }

    /**
     * Get periodStart
     *
     * @return \DateTime
     */
    public function getPeriodStart()
    {
        return $this->periodStart;
    }

    /**
     * Set periodFinal
     *
     * @param \DateTime $periodFinal
     *
     * @return Campaign
     */
    public function setPeriodFinal($periodFinal)
    {
        $this->periodFinal = $periodFinal;

        return $this;
    }

    /**
     * Get periodFinal
     *
     * @return \DateTime
     */
    public function getPeriodFinal()
    {
        return $this->periodFinal;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Campaign
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Campaign
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Campaign
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}
