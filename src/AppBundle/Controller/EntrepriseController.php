<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Entreprise;
use AppBundle\Entity\Etablissement;
use AppBundle\Entity\Nature;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Entreprise controller.
 *
 */
class EntrepriseController extends Controller
{
    /**
     * Lists all entreprise entities.
     *
     */
    public function indexAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $user = $this->getUser();
        $etudiant = $this->getUser()->getEtudiant();
        $em = $this->getDoctrine()->getManager();$qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        //$qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);
        $entreprises = $em->getRepository('AppBundle:Entreprise')->findBy(array('etudiant' =>$etudiant->getId()));
        $paginator  = $this->get('knp_paginator');
        $entreprises = $paginator->paginate(
            $entreprises,
            $request->query->getInt('page', 1),
            3
        );
        return $this->render('entreprise/index.html.twig', array(
            'etudiant' =>$etudiant,
            'entreprises' => $entreprises,
            //'quantE' =>$qantE,
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            'user'=>$user
        ));
    }
    /**
     * Lists all entreprise entities.
     *
     */


    public function erreurAction(Request $request){
        return $this->render('entreprise/erreurEntreprise.html.twig');
    }

    public function principalAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $etablissements = $em->getRepository('AppBundle:Etablissement')->findAll();
        $paginator  = $this->get('knp_paginator');
        $etablissements = $paginator->paginate(
            $etablissements,
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('entreprise/principal.html.twig', array(
            'etablissements' => $etablissements,
            'user'=>$user
        ));
    }

    /**
     * Lists all entreprise entities.
     *
     */
    public function diplomesAction(Request $request, Nature $nature)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $diplomes = $em->getRepository('AppBundle:Diplome')->findByNature($nature->getId());
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
     * Creates a new entreprise entity.
     *
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $entreprise = new Entreprise();
        $form = $this->createForm('AppBundle\Form\EntrepriseType', $entreprise);
        $form->handleRequest($request);
        $etudiant = $this->getUser()->getEtudiant();
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entreprise);
            $entreprise->setEtudiant($etudiant);
            $em->flush();

            return $this->redirectToRoute('entreprise_index');
        }

        return $this->render('entreprise/new.html.twig', array(
            'entreprise' => $entreprise,
            'form' => $form->createView(),
            'etudiant' =>$etudiant,
            'quantE' =>$qantE,
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            'user'=>$user
        ));
    }

    public function newEtudiantEntrepriseAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $etudiant = $this->getUser()->getEtudiant();
        $entrprise = new Entreprise();
        $form_entreprise = $this->createForm('AppBundle\Form\EntrepriseType', $entrprise);
        $form_entreprise->submit($request->request->get($form_entreprise->getName()));
        if ($form_entreprise->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entrprise);
            $entrprise->setEtudiant($etudiant);
            $etudiant->addEntreprise($entrprise);
            $em->flush();
            return new JsonResponse('ok');
        } else
            return new JsonResponse('Nok');
    }
    /**
     * Finds and displays a entreprise entity.
     *
     */
    public function showAction(Entreprise $entreprise)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $deleteForm = $this->createDeleteForm($entreprise);

        return $this->render('entreprise/show.html.twig', array(
            'entreprise' => $entreprise,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entreprise entity.
     *
     */
    public function editAction(Request $request, Entreprise $entreprise)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $deleteForm = $this->createDeleteForm($entreprise);
        $editForm = $this->createForm('AppBundle\Form\EntrepriseType', $entreprise);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $etudiant = $this->getUser()->getEtudiant();
        $user = $this->getUser();
        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entreprise_index');
        }

        return $this->render('entreprise/edit.html.twig', array(
            'entreprise' => $entreprise,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'etudiant' =>$etudiant,
            'quantE' =>$qantE,
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            'user'=>$user
        ));
    }

    /**
     * Deletes a entreprise entity.
     *
     */
    public function deleteAction(Entreprise $entreprise)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }

        if ($entreprise) {
            $em = $this->getDoctrine()->getManager();
            $entreprise->setEtudiant(null);
            $em->remove($entreprise);
            $em->flush();
            return $this->redirectToRoute('entreprise_index');
        }

        return $this->redirectToRoute('entreprise_index');
    }

    public function listEtudiantAction(Etablissement $etablissement){
        if($etablissement){
            $user = $this->getUser();
             $etudiants = $this->getDoctrine()->getManager()->getRepository('AppBundle:Etudiant')->findByEtablissement($etablissement->getId());
            return $this->render('entreprise/listEtudiant.html.twig',array(
                'etudiants'=>$etudiants,
                'user'=>$user
            ));
        }
        return $this->redirectToRoute('entreprise_index');
    }

    /**
     * Creates a form to delete a entreprise entity.
     *
     * @param Entreprise $entreprise The entreprise entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Entreprise $entreprise)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('entreprise_delete', array('id' => $entreprise->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
