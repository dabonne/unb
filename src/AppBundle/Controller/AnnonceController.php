<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Annonce;
use AppBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Date;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

/**
 * Annonce controller.
 *
 */
class AnnonceController extends Controller
{
    /**
     * Lists all annonce entities.
     *
     */
    public function indexAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }

        $user = $this->getUser();
        $etudiant = $this->getUser()->getEtudiant();
        $em = $this->getDoctrine()->getManager();
        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);
        $annonces = $em->getRepository('AppBundle:Annonce')->findOrderByDate();
        return $this->render('annonce/index.html.twig', array(
            'etudiant' =>$etudiant,
            'annonces' => $annonces,
            'quantE' =>$qantE,
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            'user'=>$user
        ));
    }

    public function indexAdminAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }

        $em = $this->getDoctrine()->getManager();
        //$qantD= $em->getRepository('AppBundle:Diplome')->findcountAll();
        $annonces = $em->getRepository('AppBundle:Annonce')->findBy(array(),array('date'=>'ASC'));
        return $this->render('annonce/indexAdmin.html.twig', array(
            'annonces' => $annonces
        ));
    }

    public function indexEntrepriseAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ENTREPRISE')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $annonces = $em->getRepository('AppBundle:Annonce')
            ->findByType(
            array('type' => $user->getNomUtiliwsateur()), // Critere
            array('date' => 'DESC')
        );
        return $this->render('annonce/indexEntreprise.html.twig', array(
            'annonces' => $annonces,
            'user'=>$user
        ));
    }

    /**
     * Creates a new annonce entity.
     *
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $annonce = new Annonce();
        $form = $this->createForm('AppBundle\Form\AnnonceType', $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $etudiants = $em->getRepository('AppBundle:Etudiant')->findAll();
            $user = $this->getUser();
            $annonce->setType('unb');
            $em->persist($annonce);
            $em->flush();
            if($annonce->getNatures() !== null)
            {
                //foreach ($annonce->getNatures() as $formation){
                foreach ($etudiants as $etud)
                {
                    foreach ($etud->getDiplomes() as $dipl)
                    {
                        if (in_array($dipl->getNature(),$annonce->getNatures()->toArray(),true))
                        {
                            $mailer = $this->get('mailer');
                            $message = \Swift_Message::newInstance()
                                ->setSubject('' . $annonce->getIntitule())
                                ->setFrom(array('dabonnehoda@gmail.com' => 'UNB-LIVE-REZO'))
                                ->setTo('' . $etud->getEmail())
                                ->setCharset('utf-8')
                                ->setContentType('text/html')
                                ->setBody($this->renderView('email/annonceEmail.html.twig', array(
                                    'message' => $annonce->getInformation())));
                            $attachment = \Swift_Attachment::fromPath("C:/wamp64/www/baseEtudiantV12/web/uploads/annonces/pieces/".$annonce->getPiece());
                            if ($attachment) {
                                $message->attach(($attachment));
                                $mailer->send($message);
                            } else {
                                $mailer->send($message);
                            }
                        }
                    }
                }

            }

            return $this->redirectToRoute('annonce_index_admin');
        }

        return $this->render('annonce/new.html.twig', array(
            'annonce' => $annonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new annonce entity.
     *
     */
    public function newEntrepriseAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ENTREPRISE')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $annonce = new Annonce();
        $form = $this->createForm('AppBundle\Form\AnnonceType', $annonce);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $etudiants = $em->getRepository('AppBundle:Etudiant')->findAll();
            $annonce->setType($user->getNomUtiliwsateur());
            $em->persist($annonce);
            $em->flush();
            if($annonce->getNatures() !== null)
            {
                //foreach ($annonce->getNatures() as $formation){
                    foreach ($etudiants as $etud)
                    {
                        foreach ($etud->getDiplomes() as $dipl)
                        {
                            if (in_array($dipl->getNature(),$annonce->getNatures()->toArray(),true))
                            {
                                $mailer = $this->get('mailer');
                                $message = \Swift_Message::newInstance()
                                    ->setSubject('' . $annonce->getIntitule())
                                    ->setFrom(array('dabonnehoda@gmail.com' => 'UNB-LIVE-REZO'))
                                    ->setTo('' . $etud->getEmail())
                                    ->setCharset('utf-8')
                                    ->setContentType('text/html')
                                    ->setBody($this->renderView('email/annonceEmail.html.twig', array(
                                        'message' => $annonce->getInformation())));
                                $attachment = \Swift_Attachment::fromPath("C:/wamp64/www/baseEtudiantV12/web/uploads/annonces/pieces/".$annonce->getPiece());
                                if ($attachment) {
                                    $message->attach(($attachment));
                                    $mailer->send($message);
                                } else {
                                    $mailer->send($message);
                                }
                            }
                        }
                    }

            }

            return $this->redirectToRoute('annonce_index_entreprises');
        }

        return $this->render('annonce/newEntreprise.html.twig', array(
            'annonce' => $annonce,
            'form' => $form->createView(),
            'user'=>$user
        ));
    }

    /**
     * Finds and displays a annonce entity.
     *
     */
    public function showAction(Annonce $annonce)
    {
        $deleteForm = $this->createDeleteForm($annonce);

        return $this->render('annonce/show.html.twig', array(
            'annonce' => $annonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce entity.
     *
     */
    public function editAction(Request $request, Annonce $annonce)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $deleteForm = $this->createDeleteForm($annonce);
        $editForm = $this->createForm('AppBundle\Form\AnnonceType', $annonce);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $etudiants = $em->getRepository('AppBundle:Etudiant')->findAll();
            $em->persist($annonce);
            $em->flush();
            if($annonce->getNatures() !== null)
            {
                //foreach ($annonce->getNatures() as $formation){
                foreach ($etudiants as $etud)
                {
                    foreach ($etud->getDiplomes() as $dipl) {
                        if (in_array($dipl->getNature(), $annonce->getNatures()->toArray(), true)) {
                            $mailer = $this->get('mailer');
                            $message = \Swift_Message::newInstance()
                                ->setSubject('' . $annonce->getIntitule())
                                ->setFrom(array('dabonnehoda@gmail.com' => 'UNB-LIVE-REZO'))
                                ->setTo('' . $etud->getEmail())
                                ->setCharset('utf-8')
                                ->setContentType('text/html')
                                ->setBody($this->renderView('email/annonceEmail.html.twig', array(
                                    'message' => $annonce->getInformation())));
                            $attachment = \Swift_Attachment::fromPath("C:/wamp64/www/baseEtudiantV12/web/uploads/annonces/pieces/".$annonce->getPiece());
                            if ($attachment) {
                                $message->attach(($attachment));
                                $mailer->send($message);
                            } else {
                                $mailer->send($message);
                            }
                        }
                    }
                }

            }

            return $this->redirectToRoute('annonce_index_entreprises');
        }

    }

    /**
     * Displays a form to edit an existing annonce entity.
     *
     */
    public function editEntrepriseAction(Request $request, Annonce $annonce)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ENTREPRISE')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $deleteForm = $this->createDeleteForm($annonce);
        $editForm = $this->createForm('AppBundle\Form\AnnonceType', $annonce);
        $editForm->handleRequest($request);
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $etudiants = $em->getRepository('AppBundle:Etudiant')->findAll();
            $em->persist($annonce);
            $em->flush();
            if($annonce->getNatures() !== null)
            {
                //foreach ($annonce->getNatures() as $formation){
                    foreach ($etudiants as $etud)
                    {
                        foreach ($etud->getDiplomes() as $dipl) {
                            if (in_array($dipl->getNature(), $annonce->getNatures()->toArray(), true)) {
                                $mailer = $this->get('mailer');
                                $message = \Swift_Message::newInstance()
                                    ->setSubject('' . $annonce->getIntitule())
                                    ->setFrom(array('dabonnehoda@gmail.com' => 'UNB-LIVE-REZO'))
                                    ->setTo('' . $etud->getEmail())
                                    ->setCharset('utf-8')
                                    ->setContentType('text/html')
                                    ->setBody($this->renderView('email/annonceEmail.html.twig', array(
                                        'message' => $annonce->getInformation())));
                                $attachment = \Swift_Attachment::fromPath("C:/wamp64/www/baseEtudiantV12/web/uploads/annonces/pieces/".$annonce->getPiece());
                                if ($attachment) {
                                    $message->attach(($attachment));
                                    $mailer->send($message);
                                } else {
                                    $mailer->send($message);
                                }
                            }
                        }
                    }

            }

            return $this->redirectToRoute('annonce_index_entreprises');
        }

        return $this->render('annonce/editEntreprise.html.twig', array(
            'annonce' => $annonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'user'=>$user
        ));
    }

    /**
     * Deletes a annonce entity.
     *
     */
    public function deleteAction(Annonce $annonce)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        //$form = $this->createDeleteForm($annonce);
        //$form->handleRequest($request);
        $this->get('session')->getFlashBag()->add('succes', 'Annonce supprimer');
        if (!empty($annonce)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce);
            $em->flush();
        }

        return $this->redirectToRoute('annonce_index_admin');
    }

    /**
     * Deletes a annonce entity.
     *
     */
    public function deleteEntrepriseAction(Annonce $annonce)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ENTREPRISE')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $this->get('session')->getFlashBag()->add('succes', 'Article bien enregistré');
        if (!empty($annonce)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce);
            $em->flush();
        }

        return $this->redirectToRoute('annonce_index_entreprises');
    }

    /**
     * Creates a form to delete a annonce entity.
     *
     * @param Annonce $annonce The annonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce $annonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annonce_delete', array('id' => $annonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
