<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="facture")
 */
class Facture
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_paiement = null;

    /**
     * One Facture has Many ProduitFacture.
     * @ORM\OneToMany(targetEntity="ProduitFacture", mappedBy="facture")
     */
    private $produitsFacture;

    public function __construct() {
        $this->produitsFacture = new ArrayCollection();
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
     * @return Facture
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
     * Set datePaiement
     *
     * @param \DateTime $datePaiement
     *
     * @return Facture
     */
    public function setDatePaiement($datePaiement)
    {
        $this->date_paiement = $datePaiement;

        return $this;
    }

    /**
     * Get datePaiement
     *
     * @return \DateTime
     */
    public function getDatePaiement()
    {
        return $this->date_paiement;
    }

    /**
     * Add produitsFacture
     *
     * @param \AppBundle\Entity\ProduitFacture $produitsFacture
     *
     * @return Facture
     */
    public function addProduitsFacture(\AppBundle\Entity\ProduitFacture $produitsFacture)
    {
        $this->produitsFacture[] = $produitsFacture;

        return $this;
    }

    /**
     * Remove produitsFacture
     *
     * @param \AppBundle\Entity\ProduitFacture $produitsFacture
     */
    public function removeProduitsFacture(\AppBundle\Entity\ProduitFacture $produitsFacture)
    {
        $this->produitsFacture->removeElement($produitsFacture);
    }

    /**
     * Get produitsFacture
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduitsFacture()
    {
        return $this->produitsFacture;
    }
}
