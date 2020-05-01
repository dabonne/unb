<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Nature controller.
 *
 */
class NatureController extends Controller
{
    /**
     * Lists all nature entities.
     *
     */
    public function indexAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $natures = $em->getRepository('AppBundle:Nature')->findAll();
        $paginator  = $this->get('knp_paginator');
        $natures = $paginator->paginate(
            $natures,
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('nature/index.html.twig', array(
            'formations' => $natures,
            'user'=>$user
        ));
    }

    /**
     * Creates a new nature entity.
     *
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $nature = new Nature();
        $form = $this->createForm('AppBundle\Form\NatureType', $nature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nature);
            $em->flush();

            return $this->redirectToRoute('nature_show', array('id' => $nature->getId()));
        }

        return $this->render('nature/new.html.twig', array(
            'nature' => $nature,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a nature entity.
     *
     */
    public function showAction(Nature $nature)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $deleteForm = $this->createDeleteForm($nature);

        return $this->render('nature/show.html.twig', array(
            'nature' => $nature,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing nature entity.
     *
     */
    public function editAction(Request $request, Nature $nature)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $deleteForm = $this->createDeleteForm($nature);
        $editForm = $this->createForm('AppBundle\Form\NatureType', $nature);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nature_edit', array('id' => $nature->getId()));
        }

        return $this->render('nature/edit.html.twig', array(
            'nature' => $nature,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a nature entity.
     *
     */
    public function deleteAction(Request $request, Nature $nature)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $form = $this->createDeleteForm($nature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nature);
            $em->flush();
        }

        return $this->redirectToRoute('nature_index');
    }

    /**
     * Creates a form to delete a nature entity.
     *
     * @param Nature $nature The nature entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Nature $nature)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nature_delete', array('id' => $nature->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
