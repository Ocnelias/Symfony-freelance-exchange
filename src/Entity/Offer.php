<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="offer", indexes={@ORM\Index(name="FK_user_id_offer", columns={"user_id"}), @ORM\Index(name="FK_job_id_offer", columns={"job_id"})})
 * @ORM\Entity
 */
class Offer
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
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

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
     * @ORM\Column(name="execute_period", type="integer", nullable=true)
     */
    private $executePeriod;

    /**
     * @var int|null
     *
     * @ORM\Column(name="execute_period_dimension", type="integer", nullable=true)
     */
    private $executePeriodDimension;

    /**
     * @var int
     *
     * @ORM\Column(name="created_at", type="integer", nullable=false)
     */
    private $createdAt;

    /**
     * @var \Job
     *
     * @ORM\ManyToOne(targetEntity="Job")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     * })
     */
    private $job;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

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

    public function getExecutePeriod(): ?int
    {
        return $this->executePeriod;
    }

    public function setExecutePeriod(?int $executePeriod): self
    {
        $this->executePeriod = $executePeriod;

        return $this;
    }

    public function getExecutePeriodDimension(): ?int
    {
        return $this->executePeriodDimension;
    }

    public function setExecutePeriodDimension(?int $executePeriodDimension): self
    {
        $this->executePeriodDimension = $executePeriodDimension;

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

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): self
    {
        $this->job = $job;

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
