<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\Devis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Devi controller.
 *
 * @Route("devis")
 */
class DevisController extends Controller
{
    /**
     * Lists all devi entities.
     *
     * @Route("/", name="devis_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $devis = $em->getRepository('AppBundle:Devis')->findAll();

        return $this->render('AppBundle:devis:index.html.twig', array(
            'devis' => $devis,
        ));
    }

    /**
     * Creates a new devi entity.
     *
     * @Route("/new/{id}", name="devis_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Client $client, Request $request)
    {
        $devis = new Devis();
        $devis->setClient($client);
        $em = $this->getDoctrine()->getManager();
        $em->persist($devis);
        $em->flush();

        return $this->render('AppBundle:devis:new.html.twig', array(
            'devis' => $devis,
        ));
    }

    /**
     * Finds and displays a devi entity.
     *
     * @Route("/{id}", name="devis_show")
     * @Method("GET")
     */
    public function showAction(Devis $devi)
    {
        $deleteForm = $this->createDeleteForm($devi);

        return $this->render('AppBundle:devis:show.html.twig', array(
            'devi' => $devi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing devi entity.
     *
     * @Route("/{id}/edit", name="devis_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Devis $devi)
    {
        $deleteForm = $this->createDeleteForm($devi);
        $editForm = $this->createForm('AppBundle\Form\DevisType', $devi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('devis_edit', array('id' => $devi->getId()));
        }

        return $this->render('AppBundle:devis:edit.html.twig', array(
            'devi' => $devi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a devi entity.
     *
     * @Route("/{id}", name="devis_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Devis $devi)
    {
        $form = $this->createDeleteForm($devi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($devi);
            $em->flush();
        }

        return $this->redirectToRoute('devis_index');
    }

    /**
     * Creates a form to delete a devi entity.
     *
     * @param Devis $devi The devi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Devis $devi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('devis_delete', array('id' => $devi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
