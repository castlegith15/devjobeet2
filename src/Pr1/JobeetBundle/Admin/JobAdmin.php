<?php
// src/Pr1/JobeetBundle/Admin/JobAdmin.php

namespace Pr1\JobeetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Pr1\JobeetBundle\Entity\Job;

class JobAdmin extends Admin
{

//  preview mode during create/edit
    public $supportsPreviewMode = true;

// setup the defaut sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'created_at'
    );
 
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get the current Image instance
        $job = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('label' => 'Company logo','required' => false);
        if ($job && ($webPath = $job->getWebPath())) {
             // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath().$webPath;

            // add a 'help' option containing the preview's img tag
            $fileFieldOptions['help'] = '<img src="'.$fullPath.'" class="admin-preview" />';
        }

        $formMapper
            ->add('category')
            ->add('type', 'choice', array('choices' => Job::getTypes(), 'expanded' => true))
            ->add('company')
           # ->add('logo_virtual', 'file', array('label' => 'Company logo', 'required' => false))
            ->add('logo_virtual', 'file', $fileFieldOptions)
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('how_to_apply')
            ->add('is_public')
            ->add('email')
            ->add('is_activated')
        ;
    }
 
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('category')
            ->add('company')
            ->add('position')
            ->add('description')
            ->add('is_activated')
            ->add('is_public')
            ->add('email')
            ->add('expires_at')
        ;
    }
 
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('company')
            ->add('position')
            ->add('location')
            ->add('url')
            ->add('is_activated')
            ->add('email')
            ->add('category')
            ->add('expires_at')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }
 
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('category')
            ->add('type')
            ->add('company')
            ->add('webPath', 'string', array('template' => 'Pr1JobeetBundle:JobAdmin:list_image.html.twig'))
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('how_to_apply')
            ->add('is_public')
            ->add('is_activated')
            ->add('token')
            ->add('email')
            ->add('expires_at')
        ;
    }
}
