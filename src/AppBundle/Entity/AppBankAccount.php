<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * AppBankAccount
 *
 * @ORM\Table(name="app_bank_account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AppBankAccountRepository")
 */
class AppBankAccount
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
     * @var string
     *
     * @ORM\Column(name="account_name", type="string", length=70)
     */
    private $accountName;

    /**
     * @var string
     *
     * @ORM\Column(name="agency", type="string", length=5)
     */
    private $agency;

    /**
     * @var string
     *
     * @ORM\Column(name="agency_digit", type="string", length=1)
     */
    private $agencyDigit;

    /**
     * @var string
     *
     * @ORM\Column(name="account_number", type="string", length=13)
     */
    private $accountNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="account_digit", type="string", length=1)
     */
    private $accountDigit;

    /**
     * @var string
     *
     * @ORM\Column(name="account_type", type="string", length=100)
     */
    private $accountType;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AppUser")
     * @ORM\JoinColumn(name="app_user_id", referencedColumnName="id")
     */
    private $app_user_id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AppBank", cascade={"persist"})
     * @ORM\JoinColumn(name="app_bank_id", referencedColumnName="id")
     */
    private $app_bank_id;

    // public function __construct()
    // {
    //     $this->app_bank_id = new ArrayCollection();
    // }

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
     * Set accountName
     *
     * @param string $accountName
     *
     * @return AppBankAccount
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }

    /**
     * Get accountName
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * Set agency
     *
     * @param string $agency
     *
     * @return AppBankAccount
     */
    public function setAgency($agency)
    {
        $this->agency = $agency;

        return $this;
    }

    /**
     * Get agency
     *
     * @return string
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * Set agencyDigit
     *
     * @param string $agencyDigit
     *
     * @return AppBankAccount
     */
    public function setAgencyDigit($agencyDigit)
    {
        $this->agencyDigit = $agencyDigit;

        return $this;
    }

    /**
     * Get agencyDigit
     *
     * @return string
     */
    public function getAgencyDigit()
    {
        return $this->agencyDigit;
    }

    /**
     * Set accountNumber
     *
     * @param string $accountNumber
     *
     * @return AppBankAccount
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set accountDigit
     *
     * @param string $accountDigit
     *
     * @return AppBankAccount
     */
    public function setAccountDigit($accountDigit)
    {
        $this->accountDigit = $accountDigit;

        return $this;
    }

    /**
     * Get accountDigit
     *
     * @return string
     */
    public function getAccountDigit()
    {
        return $this->accountDigit;
    }

    /**
     * Set accountType
     *
     * @param string $accountType
     *
     * @return AppBankAccount
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;

        return $this;
    }

    /**
     * Get accountType
     *
     * @return string
     */
    public function getAccountType()
    {
        return $this->accountType;
    }

    /**
     * Set appUserId.
     *
     * @param \AppBundle\Entity\AppUser|null $appUserId
     *
     * @return AppBankAccount
     */
    public function setAppUserId(\AppBundle\Entity\AppUser $appUserId = null)
    {
        $this->app_user_id = $appUserId;

        return $this;
    }

    /**
     * Get appUserId.
     *
     * @return \AppBundle\Entity\AppUser|null
     */
    public function getAppUserId()
    {
        return $this->app_user_id;
    }



    /**
     * Set appBankId.
     *
     * @param \AppBundle\Entity\AppBank $appBankId
     *
     * @return AppBankAccount
     */
    public function setAppBankId(\AppBundle\Entity\AppBank $appBankId = null)
    {
        $this->app_bank_id = $appBankId;

        return $this;
    }

    /**
     * Get appBankId.
     *
     * @return \AppBundle\Entity\AppBank|null
     */
    public function getAppBankId()
    {
        return $this->app_bank_id;
    }
}
