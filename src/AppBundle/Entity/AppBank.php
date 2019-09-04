<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * AppBank
 *
 * @ORM\Table(name="app_bank")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AppBankRepository")
 */
class AppBank
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
     * @ORM\Column(name="number", type="string", length=10)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45)
     */
    private $name;

    // /**
    //  * @ORM\OneToMany(targetEntity="AppBundle\Entity\AppBankAccount", mappedBy="appBank")
    // */
    private $app_bank_account;

    public function __construct()
    {
        $this->app_bank_account = new ArrayCollection();
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
     * Set number
     *
     * @param string $number
     *
     * @return AppBank
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AppBank
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
     * Add appBankAccount.
     *
     * @param \AppBundle\Entity\AppBankAccount $appBankAccount
     *
     * @return AppBank
     */
    public function addAppBankAccount(\AppBundle\Entity\AppBankAccount $appBankAccount)
    {
        $this->app_bank_account[] = $appBankAccount;

        return $this;
    }

    /**
     * Remove appBankAccount.
     *
     * @param \AppBundle\Entity\AppBankAccount $appBankAccount
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAppBankAccount(\AppBundle\Entity\AppBankAccount $appBankAccount)
    {
        return $this->app_bank_account->removeElement($appBankAccount);
    }

    /**
     * Get appBankAccount.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppBankAccount()
    {
        return $this->app_bank_account;
    }
}
