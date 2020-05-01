<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etudiant;
use AppBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Utilisateur controller.
 *
 */
class UtilisateurController extends Controller
{
    /**
     * Lists all utilisateur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $utilisateurs = $em->getRepository('AppBundle:Utilisateur')->findAll();

        return $this->render('utilisateur/index.html.twig', array(
            'utilisateurs' => $utilisateurs,
        ));
    }

    /**
     * Creates a new utilisateur entity.
     *
     */
    public function newAction(Request $request)
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm('AppBundle\Form\UtilisateurType', $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            return $this->redirectToRoute('utilisateur_show', array('id' => $utilisateur->getId()));
        }

        return $this->render('utilisateur/new.html.twig', array(
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a utilisateur entity.
     *
     */
    public function showAction(Utilisateur $utilisateur)
    {
        $deleteForm = $this->createDeleteForm($utilisateur);
        $em = $this->getDoctrine()->getManager();

        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($utilisateur->getEtudiant());
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($utilisateur->getEtudiant());
        //$qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($utilisateur->getEtudiant());


        return $this->render('utilisateur/show.html.twig', array(
            'user' => $utilisateur,
            'delete_form' => $deleteForm->createView(),
            'etudiant' =>$utilisateur->getEtudiant(),
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            //'quantE' =>$qantE,
        ));
    }

    public function showEntrepriseAction(Utilisateur $utilisateur)
    {
        $deleteForm = $this->createDeleteForm($utilisateur);

        return $this->render('utilisateur/showEntreprise.html.twig', array(
            'user' => $utilisateur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing utilisateur entity.
     *
     */
    public function editAction(Request $request, Utilisateur $utilisateur)
    {
        $deleteForm = $this->createDeleteForm($utilisateur);
        $editForm = $this->createForm('AppBundle\Form\UtilisateurType', $utilisateur);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($utilisateur->getEtudiant());
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($utilisateur->getEtudiant());
        //$qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($utilisateur->getEtudiant());

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            return $this->redirectToRoute('utilisateur_show', array('id' => $utilisateur->getId()));
        }

        return $this->render('utilisateur/edit.html.twig', array(
            'user' => $utilisateur->getEtudiant(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'etudiant' =>$utilisateur->getEtudiant(),
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            //'quantE' =>$qantE,
        ));
    }

    /**
     * Displays a form to edit an existing utilisateur entity.
     *
     */
    public function editEntrepriseAction(Request $request, Utilisateur $utilisateur)
    {
        $deleteForm = $this->createDeleteForm($utilisateur);
        $editForm = $this->createForm('AppBundle\Form\UtilisateurType', $utilisateur);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            return $this->redirectToRoute('utilisateur_show_entreprise', array('id' => $utilisateur->getId()));
        }

        return $this->render('utilisateur/editEntreprise.html.twig', array(
            'user' => $utilisateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Deletes a utilisateur entity.
     *
     */
    public function deleteAction(Request $request, Utilisateur $utilisateur)
    {
        $form = $this->createDeleteForm($utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($utilisateur);
            $em->flush();
        }

        return $this->redirectToRoute('utilisateur_index');
    }

    /**
     * Creates a form to delete a utilisateur entity.
     *
     * @param Utilisateur $utilisateur The utilisateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Utilisateur $utilisateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utilisateur_delete', array('id' => $utilisateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
