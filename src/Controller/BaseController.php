<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @method User getUser()
 */
abstract class BaseController extends AbstractController
{
    protected function getUser(): User
    {
        return parent::getUser();
    }
}