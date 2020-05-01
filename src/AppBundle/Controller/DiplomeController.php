<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Diplome;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Diplome controller.
 *
 */
class DiplomeController extends Controller
{
    /**
     * Lists all diplome entities.
     *
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $etudiant = $this->getUser()->getEtudiant();
        $diplomes = $em->getRepository('AppBundle:Diplome')->findBy(array('etudiant' =>$etudiant->getId()));
        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        //$qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);

        return $this->render('diplome/index.html.twig', array(
            'diplomes' => $diplomes,
            'etudiant' =>$etudiant,
            'quantC' =>$qantC,
            //'quantE' =>$qantE,
            'quantD' =>$qantD,
            'user' => $user
        ));
    }

    /**
     * Creates a new diplome entity.
     *
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $etudiant = $this->getUser()->getEtudiant();
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $diplome = new Diplome();
        $form = $this->createForm('AppBundle\Form\DiplomeType', $diplome);
        $form->handleRequest($request);
        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($diplome);
            $diplome->setEtudiant($etudiant);
            $em->flush();

            return $this->redirectToRoute('diplome_index');
        }

        return $this->render('diplome/new.html.twig', array(
            'diplome' => $diplome,
            'form' => $form->createView(),
            'etudiant' =>$etudiant,
            'quantC' =>$qantC,
            'quantE' =>$qantE,
            'quantD' =>$qantD,
            'user' => $user
        ));
    }

    /**
     * Finds and displays a diplome entity.
     *
     */
    public function showAction(Diplome $diplome)
    {
        $deleteForm = $this->createDeleteForm($diplome);

        return $this->render('diplome/show.html.twig', array(
            'diplome' => $diplome,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function verifAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $diplome = $em->getRepository('AppBundle:Diplome')->findOneBy(array('numeroDiplome'=>$request->get('numeroDiplome')));
        $diplomes[] = $diplome;
        $paginator  = $this->get('knp_paginator');
        $diplomes = $paginator->paginate(
            $diplomes,
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('diplome/indexEntreprise.html.twig', array(
            'diplomes' => $diplomes,
            'user'=>$user
        ));
    }

    /**
     * Displays a form to edit an existing diplome entity.
     *
     */
    public function editAction(Request $request, Diplome $diplome)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $etudiant = $this->getUser()->getEtudiant();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser()->getId();
        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);

        $deleteForm = $this->createDeleteForm($diplome);
        $editForm = $this->createForm('AppBundle\Form\DiplomeType', $diplome);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('diplome_index');
        }

        return $this->render('diplome/edit.html.twig', array(
            'diplome' => $diplome,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'etudiant' =>$etudiant,'quantC' =>$qantC,
            'quantE' =>$qantE,
            'quantD' =>$qantD,
            'user' =>$user
        ));
    }

    /**
     * Deletes a diplome entity.
     *
     */
    public function deleteAction(Request $request, Diplome $diplome)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $form = $this->createDeleteForm($diplome);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($diplome);
            $em->flush();
        }

        return $this->redirectToRoute('diplome_index');
    }

    /**
     * Creates a form to delete a diplome entity.
     *
     * @param Diplome $diplome The diplome entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Diplome $diplome)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diplome_delete', array('id' => $diplome->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
