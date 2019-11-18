<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Job
 *
 * @ORM\Table(name="job", indexes={@ORM\Index(name="FK_city_id_job", columns={"city_id"}), @ORM\Index(name="FK_user_id_job", columns={"user_id"}), @ORM\Index(name="FK_category_id_job", columns={"category_id"}), @ORM\Index(name="FK_country_id_job", columns={"country_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 *
 */
class Job
{

    const CURRENCY_USD = 'USD';
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_UAH = 'UAH';

    const TYPE_PERMANENT = 'Permanent job';
    const TYPE_SINGLE = 'Single project';

    const SALARY_TYPE_PROJECT = 'project';
    const SALARY_TYPE_HOUR = 'hour';
    const SALARY_TYPE_DAY = 'day';
    const SALARY_TYPE_WEEK = 'week';
    const SALARY_TYPE_MONTH = 'month';

    public static function getCurrencyList() {
        return [
            self::CURRENCY_USD,
            self::CURRENCY_EUR,
            self::CURRENCY_UAH
        ];
    }

    public static function getPermanentList() {
        return [
            self::TYPE_PERMANENT,
            self::TYPE_SINGLE,
        ];
    }

    public static function getSalaryTypeList() {
        return [
            self::SALARY_TYPE_PROJECT,
            self::SALARY_TYPE_HOUR,
            self::SALARY_TYPE_DAY,
            self::SALARY_TYPE_WEEK,
            self::SALARY_TYPE_MONTH,
        ];
    }



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
     *
     */
    private $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(min=5)
     * @Assert\Length(max=255)
     */
    private $title;


    /**
     * @var string
     *
     *
     *
     */
    private $main_category;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=5000, nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(min=3)
     * @Assert\Length(max=5000)
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="images", type="text", length=65535, nullable=true)
     */
    private $images;

    /**
     * @var string|null
     *
     * @ORM\Column(name="files", type="text", length=65535, nullable=true)
     */
    private $files;

    /**
     *
     * @var File
     */
    private $uploadedFiles;

    /**
     * @var int|null
     *
     * @ORM\Column(name="is_remote", type="integer", nullable=true)
     */
    private $isRemote;

    /**
     * @var int|null
     *
     * @ORM\Column(name="is_permanent", type="integer", nullable=false)
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
     * @ORM\Column(name="city_other", type="string", length=255, nullable=true)
     */
    private $cityOther;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cities_allowed", type="text", length=65535, nullable=true)
     */
    private $citiesAllowed;

    /**
     * @var int
     *
     * @ORM\Column(name="salary_type", type="integer", nullable=false)
     */
    private $salaryType;

    /**
     * @var int
     *
     * @ORM\Column(name="salary_currency", type="integer", nullable=false)
     */
    private $salaryCurrency;

    /**
     * @var float
     *
     * @ORM\Column(name="salary", type="float", precision=10, scale=0, nullable=false)
     * @Assert\NotBlank
     */
    private $salary;

    /**
     * @var float|null
     *
     * @ORM\Column(name="salary_pay_method", type="float", precision=10, scale=0, nullable=true)
     */
    private $salaryPayMethod;

    /**
     * @var string|null
     *
     * @ORM\Column(name="salary_comment", type="string", length=255, nullable=true)
     */
    private $salaryComment;

    /**
     * @var int|null
     *
     * @ORM\Column(name="salary_range", type="integer", nullable=true)
     */
    private $salaryRange;

    /**
     * @var float|null
     *
     * @ORM\Column(name="salary_range_from", type="float", precision=10, scale=0, nullable=true)
     */
    private $salaryRangeFrom;

    /**
     * @var float|null
     *
     * @ORM\Column(name="salary_range_to", type="float", precision=10, scale=0, nullable=true)
     */
    private $salaryRangeTo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="experience_number", type="integer", nullable=true)
     */
    private $experienceNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="experience_dimension", type="integer", nullable=true)
     */
    private $experienceDimension;

    /**
     * @var int|null
     *
     * @ORM\Column(name="seek_period", type="integer", nullable=true)
     */
    private $seekPeriod;

    /**
     * @var int|null
     *
     * @ORM\Column(name="seek_period_dimension", type="integer", nullable=true)
     */
    private $seekPeriodDimension;

    /**
     * @var int|null
     *
     * @ORM\Column(name="education", type="integer", nullable=true)
     */
    private $education;

    /**
     * @var int|null
     *
     * @ORM\Column(name="age_from", type="integer", nullable=true)
     */
    private $ageFrom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="age_to", type="integer", nullable=true)
     */
    private $ageTo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="skills", type="text", length=65535, nullable=true)
     */
    private $skills;

    /**
     * @var string|null
     *
     * @ORM\Column(name="languages", type="text", length=65535, nullable=true)
     */
    private $languages;

    /**
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var \Category
     *
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \City
     *
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * })
     */
    private $city;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function setUploadedFiles(File $file= null)
    {
        $this->uploadedFiles = $file;
    }

    public function getUploadedFiles()
    {
        return $this->uploadedFiles;
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getFiles(): ?string
    {
        return $this->files;
    }

    public function setFiles(?string $files): self
    {
        $this->files = $files;

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

    public function getIsPermanent(): ?string
    {
        return  $this->isPermanent;
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

    public function getCityOther(): ?string
    {
        return $this->cityOther;
    }

    public function setCityOther(?string $cityOther): self
    {
        $this->cityOther = $cityOther;

        return $this;
    }

    public function getCitiesAllowed(): ?string
    {
        return $this->citiesAllowed;
    }

    public function setCitiesAllowed(?string $citiesAllowed): self
    {
        $this->citiesAllowed = $citiesAllowed;

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

    public function getSalaryPayMethod(): ?float
    {
        return $this->salaryPayMethod;
    }

    public function setSalaryPayMethod(?float $salaryPayMethod): self
    {
        $this->salaryPayMethod = $salaryPayMethod;

        return $this;
    }

    public function getSalaryComment(): ?string
    {
        return $this->salaryComment;
    }

    public function setSalaryComment(?string $salaryComment): self
    {
        $this->salaryComment = $salaryComment;

        return $this;
    }

    public function getSalaryRange(): ?int
    {
        return $this->salaryRange;
    }

    public function setSalaryRange(?int $salaryRange): self
    {
        $this->salaryRange = $salaryRange;

        return $this;
    }

    public function getSalaryRangeFrom(): ?float
    {
        return $this->salaryRangeFrom;
    }

    public function setSalaryRangeFrom(?float $salaryRangeFrom): self
    {
        $this->salaryRangeFrom = $salaryRangeFrom;

        return $this;
    }

    public function getSalaryRangeTo(): ?float
    {
        return $this->salaryRangeTo;
    }

    public function setSalaryRangeTo(?float $salaryRangeTo): self
    {
        $this->salaryRangeTo = $salaryRangeTo;

        return $this;
    }

    public function getExperienceNumber(): ?int
    {
        return $this->experienceNumber;
    }

    public function setExperienceNumber(?int $experienceNumber): self
    {
        $this->experienceNumber = $experienceNumber;

        return $this;
    }

    public function getExperienceDimension(): ?int
    {
        return $this->experienceDimension;
    }

    public function setExperienceDimension(?int $experienceDimension): self
    {
        $this->experienceDimension = $experienceDimension;

        return $this;
    }

    public function getSeekPeriod(): ?int
    {
        return $this->seekPeriod;
    }

    public function setSeekPeriod(?int $seekPeriod): self
    {
        $this->seekPeriod = $seekPeriod;

        return $this;
    }

    public function getSeekPeriodDimension(): ?int
    {
        return $this->seekPeriodDimension;
    }

    public function setSeekPeriodDimension(?int $seekPeriodDimension): self
    {
        $this->seekPeriodDimension = $seekPeriodDimension;

        return $this;
    }

    public function getEducation(): ?int
    {
        return $this->education;
    }

    public function setEducation(?int $education): self
    {
        $this->education = $education;

        return $this;
    }

    public function getAgeFrom(): ?int
    {
        return $this->ageFrom;
    }

    public function setAgeFrom(?int $ageFrom): self
    {
        $this->ageFrom = $ageFrom;

        return $this;
    }

    public function getAgeTo(): ?int
    {
        return $this->ageTo;
    }

    public function setAgeTo(?int $ageTo): self
    {
        $this->ageTo = $ageTo;

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

    public function getLanguages(): ?string
    {
        return $this->languages;
    }

    public function setLanguages(?string $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function setCreatedAt(int $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(int $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

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
