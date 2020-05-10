<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $utilisateur = $this->getUser();
        if ($utilisateur instanceof Utilisateur && $utilisateur->hasRole('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin');
        }

        if ($utilisateur instanceof Utilisateur && $utilisateur->hasRole('ROLE_PARTENAIRE')){
            return $this->redirectToRoute('entreprise_erreur');
        }

        if ($utilisateur instanceof Utilisateur && $utilisateur->hasRole('ROLE_ETUDIANT')){
            return $this->redirectToRoute('entreprise_erreur');
        }
        else return $this->redirectToRoute('fos_user_security_login');
    }
}
