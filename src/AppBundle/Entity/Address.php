<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
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
     * @ORM\Column(name="City", type="string", length=50)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="Street", type="string", length=50)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="HomeNum", type="string", length=10)
     */
    private $homeNum;

    /**
     * @var string
     *
     * @ORM\Column(name="FlatNum", type="string", length=10, nullable=true)
     */
    private $flatNum;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Contact", inversedBy="address")
     */
    private $contact;

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
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set homeNum
     *
     * @param string $homeNum
     * @return Address
     */
    public function setHomeNum($homeNum)
    {
        $this->homeNum = $homeNum;

        return $this;
    }

    /**
     * Get homeNum
     *
     * @return string 
     */
    public function getHomeNum()
    {
        return $this->homeNum;
    }

    /**
     * Set flatNum
     *
     * @param string $flatNum
     * @return Address
     */
    public function setFlatNum($flatNum)
    {
        $this->flatNum = $flatNum;

        return $this;
    }

    /**
     * Get flatNum
     *
     * @return string 
     */
    public function getFlatNum()
    {
        return $this->flatNum;
    }

    /**
     * Set contact
     *
     * @param \AppBundle\Entity\Contact $contact
     * @return Address
     */
    public function setContact(\AppBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \AppBundle\Entity\Contact 
     */
    public function getContact()
    {
        return $this->contact;
    }
}
