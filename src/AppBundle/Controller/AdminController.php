<?php
/**
 * Created by PhpStorm.
 * User: dabonne
 * Date: 17/10/2018
 * Time: 01:28
 */
namespace App\Controller;

namespace AppBundle\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    public function createNewUserEntity()
    {

        $utilisateur = $this->get('fos_user.user_manager');
        return $utilisateur->createUser();
    }

    public function persistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }

    public function updateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }
}