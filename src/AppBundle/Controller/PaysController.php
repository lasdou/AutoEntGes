<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pays;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pay controller.
 *
 * @Route("pays")
 */
class PaysController extends Controller
{
    /**
     * Lists all pay entities.
     *
     * @Route("/", name="pays_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pays = $em->getRepository('AppBundle:Pays')->findAll();

        return $this->render('AppBundle:pays:index.html.twig', array(
            'pays' => $pays,
        ));
    }

    /**
     * Creates a new pay entity.
     *
     * @Route("/new", name="pays_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pays = new Pays();
        $form = $this->createForm('AppBundle\Form\PaysType', $pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pays);
            $em->flush();

            return $this->redirectToRoute('pays_show', array('id' => $pays->getId()));
        }


        return $this->render('form_popin.html.twig', array(
            'title' => 'Ajouter un nouveau pays : ',
            'form' => $form->createView(),
            'submit_label' => 'Créer',
            'action_path' => $this->generateUrl('pays_new'),
        ));
    }

    /**
     * Finds and displays a pay entity.
     *
     * @Route("/{id}", name="pays_show")
     * @Method("GET")
     */
    public function showAction(Pays $pays)
    {
        $deleteForm = $this->createDeleteForm($pays);

        return $this->render('AppBundle:pays:show.html.twig', array(
            'pays' => $pays,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pay entity.
     *
     * @Route("/{id}/edit", name="pays_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pays $pays)
    {
        $deleteForm = $this->createDeleteForm($pays);
        $editForm = $this->createForm('AppBundle\Form\PaysType', $pays);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pays_index');
        }

        return $this->render('form_popin.html.twig', array(
            'title' => 'Modification du pays : '.$pays,
            'form' => $editForm->createView(),
            'submit_label' => 'modifier',
            'action_path' => $this->generateUrl('pays_edit', ['id' => $pays->getId()]),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pay entity.
     *
     * @Route("/{id}", name="pays_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pays $pays)
    {
        $form = $this->createDeleteForm($pays);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pays);
            $em->flush();
        }

        return $this->redirectToRoute('pays_index');
    }

    /**
     * Creates a form to delete a pay entity.
     *
     * @param Pays $pay The pay entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pays $pays)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pays_delete', array('id' => $pays->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
