<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="devis")
 */
class Devis
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_creation;


    /**
     * One Devis has Many ProduitDevis.
     * @ORM\OneToMany(targetEntity="ProduitDevis", mappedBy="devis")
     */
    private $produitsDevis;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    public function __construct() {
        $this->produitsDevis = new ArrayCollection();
        $this->date_creation = new \DateTime();
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Devis
     */
    public function setDateCreation($dateCreation)
    {
        $this->date_creation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * Add produitsDevi
     *
     * @param \AppBundle\Entity\ProduitDevis $produitsDevi
     *
     * @return Devis
     */
    public function addProduitsDevi(\AppBundle\Entity\ProduitDevis $produitsDevi)
    {
        $this->produitsDevis[] = $produitsDevi;

        return $this;
    }

    /**
     * Remove produitsDevi
     *
     * @param \AppBundle\Entity\ProduitDevis $produitsDevi
     */
    public function removeProduitsDevi(\AppBundle\Entity\ProduitDevis $produitsDevi)
    {
        $this->produitsDevis->removeElement($produitsDevi);
    }

    /**
     * Get produitsDevis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduitsDevis()
    {
        return $this->produitsDevis;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Devis
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
