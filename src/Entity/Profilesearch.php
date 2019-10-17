<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profilesearch
 *
 * @ORM\Table(name="profileSearch", indexes={@ORM\Index(name="FK_user_id_profileSearch", columns={"user_id"})})
 * @ORM\Entity
 */
class Profilesearch
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint", nullable=false)
     */
    private $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city_other", type="string", length=255, nullable=true)
     */
    private $cityOther;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var int|null
     *
     * @ORM\Column(name="salary_type", type="integer", nullable=true)
     */
    private $salaryType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="salary_currency", type="integer", nullable=true)
     */
    private $salaryCurrency;

    /**
     * @var float|null
     *
     * @ORM\Column(name="salary", type="float", precision=10, scale=0, nullable=true)
     */
    private $salary;

    /**
     * @var int|null
     *
     * @ORM\Column(name="is_remote", type="integer", nullable=true)
     */
    private $isRemote;

    /**
     * @var int|null
     *
     * @ORM\Column(name="is_permanent", type="integer", nullable=true)
     */
    private $isPermanent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="permanent_type", type="integer", nullable=true)
     */
    private $permanentType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="skills", type="text", length=65535, nullable=true)
     */
    private $skills;

    /**
     * @var int
     *
     * @ORM\Column(name="created_at", type="integer", nullable=false)
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="updated_at", type="integer", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCityOther(): ?string
    {
        return $this->cityOther;
    }

    public function setCityOther(?string $cityOther): self
    {
        $this->cityOther = $cityOther;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getSalaryType(): ?int
    {
        return $this->salaryType;
    }

    public function setSalaryType(?int $salaryType): self
    {
        $this->salaryType = $salaryType;

        return $this;
    }

    public function getSalaryCurrency(): ?int
    {
        return $this->salaryCurrency;
    }

    public function setSalaryCurrency(?int $salaryCurrency): self
    {
        $this->salaryCurrency = $salaryCurrency;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(?float $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getIsRemote(): ?int
    {
        return $this->isRemote;
    }

    public function setIsRemote(?int $isRemote): self
    {
        $this->isRemote = $isRemote;

        return $this;
    }

    public function getIsPermanent(): ?int
    {
        return $this->isPermanent;
    }

    public function setIsPermanent(?int $isPermanent): self
    {
        $this->isPermanent = $isPermanent;

        return $this;
    }

    public function getPermanentType(): ?int
    {
        return $this->permanentType;
    }

    public function setPermanentType(?int $permanentType): self
    {
        $this->permanentType = $permanentType;

        return $this;
    }

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(?string $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }

    public function setCreatedAt(int $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?int
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(int $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
