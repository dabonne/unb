<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Universite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Universite controller.
 *
 */
class UniversiteController extends Controller
{
    /**
     * Lists all universite entities.
     *
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();

        $universites = $em->getRepository('AppBundle:Universite')->findAll();

        return $this->render('universite/index.html.twig', array(
            'universites' => $universites,
        ));
    }

    /**
     * Creates a new universite entity.
     *
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $universite = new Universite();
        $form = $this->createForm('AppBundle\Form\UniversiteType', $universite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($universite);
            $em->flush();

            return $this->redirectToRoute('universite_show', array('id' => $universite->getId()));
        }

        return $this->render('universite/new.html.twig', array(
            'universite' => $universite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a universite entity.
     *
     */
    public function showAction(Universite $universite)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $deleteForm = $this->createDeleteForm($universite);

        return $this->render('universite/show.html.twig', array(
            'universite' => $universite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing universite entity.
     *
     */
    public function editAction(Request $request, Universite $universite)
    {
        $deleteForm = $this->createDeleteForm($universite);
        $editForm = $this->createForm('AppBundle\Form\UniversiteType', $universite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('universite_edit', array('id' => $universite->getId()));
        }

        return $this->render('universite/edit.html.twig', array(
            'universite' => $universite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a universite entity.
     *
     */
    public function deleteAction(Request $request, Universite $universite)
    {
        $form = $this->createDeleteForm($universite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($universite);
            $em->flush();
        }

        return $this->redirectToRoute('universite_index');
    }

    /**
     * Creates a form to delete a universite entity.
     *
     * @param Universite $universite The universite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Universite $universite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('universite_delete', array('id' => $universite->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
