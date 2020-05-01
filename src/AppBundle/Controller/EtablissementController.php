<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etablissement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Etablissement controller.
 *
 */
class EtablissementController extends Controller
{
    /**
     * Lists all etablissement entities.
     *
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();

        $etablissements = $em->getRepository('AppBundle:Etablissement')->findAll();

        return $this->render('etablissement/index.html.twig', array(
            'etablissements' => $etablissements,
        ));
    }

    /**
     * Creates a new etablissement entity.
     *
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $etablissement = new Etablissement();
        $form = $this->createForm('AppBundle\Form\EtablissementType', $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etablissement);
            $em->flush();

            return $this->redirectToRoute('etablissement_show', array('id' => $etablissement->getId()));
        }

        return $this->render('etablissement/new.html.twig', array(
            'etablissement' => $etablissement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etablissement entity.
     *
     */
    public function showAction(Etablissement $etablissement, Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $formations = $etablissement->getNatures();
        $paginator  = $this->get('knp_paginator');
        $formations = $paginator->paginate(
            $formations,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('etablissement/show.html.twig', array(
            'etablissement' => $etablissement,
            'formations' =>$formations,
            'user'=>$user
        ));
    }

    /**
     * Displays a form to edit an existing etablissement entity.
     *
     */
    public function editAction(Request $request, Etablissement $etablissement)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $deleteForm = $this->createDeleteForm($etablissement);
        $editForm = $this->createForm('AppBundle\Form\EtablissementType', $etablissement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etablissement_edit', array('id' => $etablissement->getId()));
        }

        return $this->render('etablissement/edit.html.twig', array(
            'etablissement' => $etablissement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etablissement entity.
     *
     */
    public function deleteAction(Request $request, Etablissement $etablissement)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $form = $this->createDeleteForm($etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etablissement);
            $em->flush();
        }

        return $this->redirectToRoute('etablissement_index');
    }

    /**
     * Creates a form to delete a etablissement entity.
     *
     * @param Etablissement $etablissement The etablissement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Etablissement $etablissement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etablissement_delete', array('id' => $etablissement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
