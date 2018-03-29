<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Civilite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Civilite controller.
 *
 * @Route("civilite")
 */
class CiviliteController extends Controller
{
    /**
     * Lists all civilite entities.
     *
     * @Route("/", name="civilite_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $civilites = $em->getRepository('AppBundle:Civilite')->findAll();

        return $this->render('AppBundle:civilite:index.html.twig', array(
            'civilites' => $civilites,
        ));
    }

    /**
     * Creates a new civilite entity.
     *
     * @Route("/new", name="civilite_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $civilite = new Civilite();
        $form = $this->createForm('AppBundle\Form\CiviliteType', $civilite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($civilite);
            $em->flush();

            return $this->redirectToRoute('civilite_show', array('id' => $civilite->getId()));
        }

        return $this->render('AppBundle:civilite:new.html.twig', array(
            'civilite' => $civilite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a civilite entity.
     *
     * @Route("/{id}", name="civilite_show")
     * @Method("GET")
     */
    public function showAction(Civilite $civilite)
    {
        $deleteForm = $this->createDeleteForm($civilite);

        return $this->render('AppBundle:civilite:show.html.twig', array(
            'civilite' => $civilite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing civilite entity.
     *
     * @Route("/{id}/edit", name="civilite_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Civilite $civilite)
    {
        $deleteForm = $this->createDeleteForm($civilite);
        $editForm = $this->createForm('AppBundle\Form\CiviliteType', $civilite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('civilite_edit', array('id' => $civilite->getId()));
        }

        return $this->render('AppBundle:civilite:edit.html.twig', array(
            'civilite' => $civilite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a civilite entity.
     *
     * @Route("/{id}", name="civilite_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Civilite $civilite)
    {
        $form = $this->createDeleteForm($civilite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($civilite);
            $em->flush();
        }

        return $this->redirectToRoute('civilite_index');
    }

    /**
     * Creates a form to delete a civilite entity.
     *
     * @param Civilite $civilite The civilite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Civilite $civilite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('civilite_delete', array('id' => $civilite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
