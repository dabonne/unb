<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Certificat;
use AppBundle\Entity\Diplome;
use AppBundle\Entity\Entreprise;
use AppBundle\Entity\Etudiant;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * Etudiant controller.
 *
 */
class EtudiantController extends Controller
{
    public function acceuilleAction()
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        return $this->render('etudiant/acceuille.html.twig',array(
            'user' => $user,
            'form' => $form->createView()
            )
        );
    }


    /**
     * Lists all etudiant entities.
     *
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();

        $etudiants = $em->getRepository('AppBundle:Etudiant')->findAll();

        return $this->render('etudiant/index.html.twig', array(
            'etudiants' => $etudiants,
        ));
    }

    public function matriculeAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $matricule = $request->get('matricule');
        $em = $this->getDoctrine()->getManager();
        $etudiant = $em->getRepository('AppBundle:Etudiant')->findMatrucule($matricule);
        $etud = json_encode($etudiant);
        return new JsonResponse($etud);

    }

    /**
     * Creates a new etudiant entity.
     *
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $etudiant = new Etudiant();
        $form = $this->createForm('AppBundle\Form\EtudiantType', $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();

            return $this->redirectToRoute('etudiant_show', array('id' => $etudiant->getId()));
        }

        return $this->render('etudiant/new.html.twig', array(
            'etudiant' => $etudiant,
            'form' => $form->createView(),
        ));
    }

    public function addPhotoAction(Request $request)
    {
        $etudiant = $this->getUser()->getEtudiant();
        $form_photo = $this->createForm('AppBundle\Form\PhotoType');
        $form_photo->submit($request->request->get($form_photo->getName()));
        if ($form_photo->isValid()) {
            $etudiant->setImageFile($form_photo->getData('imageFile'));
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return new JsonResponse('ok');
        } else
            return new JsonResponse('');
    }

    protected function getFormErrors($form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error){
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $key => $child) {
            if ($err = $this->getErrorsAsArray($child))
                $errors[$key] = $err;
        }
        return $errors;
    }
    /**
     * Finds and displays a etudiant entity.
     *
     */
    public function showAction(Etudiant $etudiant)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $etablissement = $etudiant->getEtablissement();
        $user = $this->getUser();
        return $this->render('etudiant/show.html.twig', array(
            'etudiant' => $etudiant,
            'etablissement' =>$etablissement,
            'user' =>$user

        ));
    }

    /**
     * Finds and displays a etudiant entity.
     *
     */
    public function showEtudiantAction(Etudiant $etudiant)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();$qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);
        $entreprises = $em->getRepository('AppBundle:Entreprise')->findBy(array('etudiant' =>$etudiant->getId()));

        return $this->render('etudiant/showEtudiant.html.twig', array(
            'etudiant' => $etudiant,
            'entreprises' => $entreprises,
            'quantE' =>$qantE,
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            'user'=>$user

        ));
    }


    /**
     * Displays a form to edit an existing etudiant entity.
     *
     */
    public function editAction(Request $request, Etudiant $etudiant)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();$qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);
        $entreprises = $em->getRepository('AppBundle:Entreprise')->findBy(array('etudiant' =>$etudiant->getId()));

        $deleteForm = $this->createDeleteForm($etudiant);
        $editForm = $this->createForm('AppBundle\Form\EtudiantType', $etudiant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etudiant_show_etudiant', array('id' => $etudiant->getId()));
        }

        return $this->render('etudiant/edit.html.twig', array(
            'etudiant' => $etudiant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'entreprises' => $entreprises,
            'quantE' =>$qantE,
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            'user'=>$user
        ));
    }

    /**
     * Deletes a etudiant entity.
     *
     */
    public function deleteAction(Request $request, Etudiant $etudiant)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $form = $this->createDeleteForm($etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etudiant);
            $em->flush();
        }

        return $this->redirectToRoute('etudiant_index');
    }

    /**
     * Creates a form to delete a etudiant entity.
     *
     * @param Etudiant $etudiant The etudiant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Etudiant $etudiant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etudiant_delete', array('id' => $etudiant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
