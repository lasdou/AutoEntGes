<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="produit_facture")
 */
class ProduitFacture
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $code;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $prix_ht = 0;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $quantite = 0;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $remise_ht = 0;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Facture", inversedBy="produitsFacture")
     * @ORM\JoinColumn(name="facture_id", referencedColumnName="id")
     */
    private $facture;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return ProduitFacture
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return ProduitFacture
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set prixHt
     *
     * @param string $prixHt
     *
     * @return ProduitFacture
     */
    public function setPrixHt($prixHt)
    {
        $this->prix_ht = $prixHt;

        return $this;
    }

    /**
     * Get prixHt
     *
     * @return string
     */
    public function getPrixHt()
    {
        return $this->prix_ht;
    }

    /**
     * Set quantite
     *
     * @param string $quantite
     *
     * @return ProduitFacture
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return string
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set remiseHt
     *
     * @param string $remiseHt
     *
     * @return ProduitFacture
     */
    public function setRemiseHt($remiseHt)
    {
        $this->remise_ht = $remiseHt;

        return $this;
    }

    /**
     * Get remiseHt
     *
     * @return string
     */
    public function getRemiseHt()
    {
        return $this->remise_ht;
    }

    /**
     * Set facture
     *
     * @param \AppBundle\Entity\Facture $facture
     *
     * @return ProduitFacture
     */
    public function setFacture(\AppBundle\Entity\Facture $facture = null)
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * Get facture
     *
     * @return \AppBundle\Entity\Facture
     */
    public function getFacture()
    {
        return $this->facture;
    }
}
