<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Certificat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Certificat controller.
 *
 */
class CertificatController extends Controller
{
    /**
     * Lists all certificat entities.
     *
     */
    public function indexAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $em = $this->getDoctrine()->getManager();
        $etudiant = $this->getUser()->getEtudiant();
        $user = $this->getUser();
        $certificats = $em->getRepository('AppBundle:Certificat')->findBy(array('etudiant' =>$etudiant->getId()));
        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);

        return $this->render('certificat/index.html.twig', array(
            'certificats' => $certificats,
            'etudiant' =>$etudiant,
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            'quantE' =>$qantE,
            'user'=>$user
        ));
    }

    /**
     * Creates a new certificat entity.
     *
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $certificat = new Certificat();
        $user = $this->getUser();
        $etudiant = $this->getUser()->getEtudiant();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('AppBundle\Form\CertificatType', $certificat);
        $form->handleRequest($request);
        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($certificat);
            $certificat->setEtudiant($etudiant);
            $em->flush();

            return $this->redirectToRoute('certificat_index');
        }

        return $this->render('certificat/new.html.twig', array(
            'certificat' => $certificat,
            'form' => $form->createView(),
            'etudiant' =>$etudiant,
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            'quantE' =>$qantE,
            'user'=>$user
        ));
    }

    /**
     * Finds and displays a certificat entity.
     *
     */
    public function showAction(Certificat $certificat)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $deleteForm = $this->createDeleteForm($certificat);

        return $this->render('certificat/show.html.twig', array(
            'certificat' => $certificat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing certificat entity.
     *
     */
    public function editAction(Request $request, Certificat $certificat)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $etudiant = $this->getUser()->getEtudiant();
        $deleteForm = $this->createDeleteForm($certificat);
        $editForm = $this->createForm('AppBundle\Form\CertificatType', $certificat);
        $editForm->handleRequest($request);
        $qantC= $em->getRepository('AppBundle:Certificat')->countByetudiant($etudiant);
        $qantD= $em->getRepository('AppBundle:Diplome')->countByetudiant($etudiant);
        $qantE= $em->getRepository('AppBundle:Entreprise')->countByetudiant($etudiant);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('certificat_index');
        }

        return $this->render('certificat/edit.html.twig', array(
            'certificat' => $certificat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'etudiant' =>$etudiant,
            'quantC' =>$qantC,
            'quantD' =>$qantD,
            'quantE' =>$qantE,
            'user'=>$user
        ));
    }

    /**
     * Deletes a certificat entity.
     *
     */
    public function deleteAction(Request $request, Certificat $certificat)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {

            $this->addFlash('error' , 'L\'accès à la page est refusé !');
            return $this->redirectToRoute('fos_user_security_login');
        }
        $form = $this->createDeleteForm($certificat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($certificat);
            $em->flush();
        }

        return $this->redirectToRoute('certificat_index');
    }

    /**
     * Creates a form to delete a certificat entity.
     *
     * @param Certificat $certificat The certificat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Certificat $certificat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('certificat_delete', array('id' => $certificat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
