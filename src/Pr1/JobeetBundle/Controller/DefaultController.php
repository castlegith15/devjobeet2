<?php

namespace Pr1\JobeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Pr1JobeetBundle:Default:index.html.twig', array('name' => $name));
    }
}
