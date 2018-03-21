<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="produit_devis")
 */
class ProduitDevis
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
     * Many ProduitsDevis have One Devis.
     * @ORM\ManyToOne(targetEntity="Devis", inversedBy="produitsDevis")
     * @ORM\JoinColumn(name="devis_id", referencedColumnName="id")
     */
    private $devis;


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
     * @return ProduitDevis
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
     * @return ProduitDevis
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
     * @return ProduitDevis
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
     * @return ProduitDevis
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
     * @return ProduitDevis
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
     * Set devis
     *
     * @param \AppBundle\Entity\Devis $devis
     *
     * @return ProduitDevis
     */
    public function setDevis(\AppBundle\Entity\Devis $devis = null)
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * Get devis
     *
     * @return \AppBundle\Entity\Devis
     */
    public function getDevis()
    {
        return $this->devis;
    }
}
