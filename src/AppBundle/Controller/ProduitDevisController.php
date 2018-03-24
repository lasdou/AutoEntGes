<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProduitDevis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Produitdevi controller.
 *
 * @Route("produitdevis")
 */
class ProduitDevisController extends Controller
{
    /**
     * Lists all produitDevi entities.
     *
     * @Route("/", name="produitdevis_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produitDevis = $em->getRepository('AppBundle:ProduitDevis')->findAll();

        return $this->render('AppBundle:produitdevis:index.html.twig', array(
            'produitDevis' => $produitDevis,
        ));
    }

    /**
     * Creates a new produitDevi entity.
     *
     * @Route("/new", name="produitdevis_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produitDevi = new Produitdevi();
        $form = $this->createForm('AppBundle\Form\ProduitDevisType', $produitDevi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produitDevi);
            $em->flush();

            return $this->redirectToRoute('produitdevis_show', array('id' => $produitDevi->getId()));
        }

        return $this->render('AppBundle:produitdevis:new.html.twig', array(
            'produitDevi' => $produitDevi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produitDevi entity.
     *
     * @Route("/{id}", name="produitdevis_show")
     * @Method("GET")
     */
    public function showAction(ProduitDevis $produitDevi)
    {
        $deleteForm = $this->createDeleteForm($produitDevi);

        return $this->render('AppBundle:produitdevis:show.html.twig', array(
            'produitDevi' => $produitDevi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produitDevi entity.
     *
     * @Route("/{id}/edit", name="produitdevis_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProduitDevis $produitDevi)
    {
        $deleteForm = $this->createDeleteForm($produitDevi);
        $editForm = $this->createForm('AppBundle\Form\ProduitDevisType', $produitDevi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produitdevis_edit', array('id' => $produitDevi->getId()));
        }

        return $this->render('AppBundle:produitdevis:edit.html.twig', array(
            'produitDevi' => $produitDevi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produitDevi entity.
     *
     * @Route("/{id}", name="produitdevis_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProduitDevis $produitDevi)
    {
        $form = $this->createDeleteForm($produitDevi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produitDevi);
            $em->flush();
        }

        return $this->redirectToRoute('produitdevis_index');
    }

    /**
     * Creates a form to delete a produitDevi entity.
     *
     * @param ProduitDevis $produitDevi The produitDevi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProduitDevis $produitDevi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produitdevis_delete', array('id' => $produitDevi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
