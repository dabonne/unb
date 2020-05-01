<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etudiant;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * Lists all user entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $matricule = $form->get('matricule')->getData();
            $etudiant = $em->getRepository('AppBundle:Etudiant')->findOneBy(array('matricule' => $matricule));
            if($etudiant && $etudiant->getUser() === null){
                $em->persist($user);
                $user->setEtudiant($etudiant);
                $user->setRoles(array('USER'));
                $em->flush();
                return $this->redirectToRoute('fos_user_security_logout');
            }
            else return $this->render('user/new.html.twig', array(
                'user' => $user,
                'form' => $form->createView(),
            ));

        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    public function newEtudiantCompteAction(Request $request)
    {
       $em = $this->getDoctrine()->getManager();
       $user = new User();
       $form = $this->createForm('AppBundle\Form\UserType', $user);
       $form->submit($request->request->get($form->getName(),null));
          if ($form->isValid()) {
              $matricule = $form->get('matricule')->getData();
              $etudiant = $em->getRepository('AppBundle:Etudiant')->findOneBy(array('matricule' => $matricule));
              if($etudiant instanceof Etudiant && $etudiant->getUser() === null){
                  $em->persist($user);
                  $user->setEtudiant($etudiant);
                  $user->setRoles(array('USER'));
                  $etudiant->setUser($user);
                  $em->flush();
                  return new JsonResponse('ok');
              } else
                  return new JsonResponse('Compte');
              }
        return new JsonResponse('Nok');
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(User $user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
