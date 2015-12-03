<?php

namespace Pr1\JobeetBundle\Controller;

use Pr1\JobeetBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
use Symfony\Component\HttpFoundation\Request;
**/

/**
* Category controller
*
*/

class CategoryController extends Controller
{
     public function showAction($slug)
     {
            $em = $this->getDoctrine()->getManager();
 
            $category = $em->getRepository('Pr1JobeetBundle:Category')->findOneBySlug($slug);
 
           if (!$category) {
        throw $this->createNotFoundException('Unable to find Category entity.');
        } 
 
            $category->setActiveJobs($em->getRepository('Pr1JobeetBundle:Job')->getActiveJobs($category->getId()));
 
         return $this->render('Pr1JobeetBundle:Category:show.html.twig', array(
        'category' => $category));
        }
}
