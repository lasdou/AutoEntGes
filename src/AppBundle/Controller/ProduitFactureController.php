<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProduitFacture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Produitfacture controller.
 *
 * @Route("produitfacture")
 */
class ProduitFactureController extends Controller
{
    /**
     * Lists all produitFacture entities.
     *
     * @Route("/", name="produitfacture_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produitFactures = $em->getRepository('AppBundle:ProduitFacture')->findAll();

        return $this->render('AppBundle:produitfacture:index.html.twig', array(
            'produitFactures' => $produitFactures,
        ));
    }

    /**
     * Creates a new produitFacture entity.
     *
     * @Route("/new", name="produitfacture_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $produitFacture = new Produitfacture();
        $form = $this->createForm('AppBundle\Form\ProduitFactureType', $produitFacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produitFacture);
            $em->flush();

            return $this->redirectToRoute('produitfacture_show', array('id' => $produitFacture->getId()));
        }

        return $this->render('AppBundle:produitfacture:new.html.twig', array(
            'produitFacture' => $produitFacture,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produitFacture entity.
     *
     * @Route("/{id}", name="produitfacture_show")
     * @Method("GET")
     */
    public function showAction(ProduitFacture $produitFacture)
    {
        $deleteForm = $this->createDeleteForm($produitFacture);

        return $this->render('AppBundle:produitfacture:show.html.twig', array(
            'produitFacture' => $produitFacture,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produitFacture entity.
     *
     * @Route("/{id}/edit", name="produitfacture_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProduitFacture $produitFacture)
    {
        $deleteForm = $this->createDeleteForm($produitFacture);
        $editForm = $this->createForm('AppBundle\Form\ProduitFactureType', $produitFacture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produitfacture_edit', array('id' => $produitFacture->getId()));
        }

        return $this->render('AppBundle:produitfacture:edit.html.twig', array(
            'produitFacture' => $produitFacture,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produitFacture entity.
     *
     * @Route("/{id}", name="produitfacture_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProduitFacture $produitFacture)
    {
        $form = $this->createDeleteForm($produitFacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produitFacture);
            $em->flush();
        }

        return $this->redirectToRoute('produitfacture_index');
    }

    /**
     * Creates a form to delete a produitFacture entity.
     *
     * @param ProduitFacture $produitFacture The produitFacture entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProduitFacture $produitFacture)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produitfacture_delete', array('id' => $produitFacture->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
