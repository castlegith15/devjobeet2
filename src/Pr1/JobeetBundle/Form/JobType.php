<?php

namespace Pr1\JobeetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Pr1\JobeetBundle\Entity\Job;

class JobType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type','choice', array('choices' => Job::getTypes(), 'expanded' => true))
            ->add('category')
            ->add('company')
            ->add('logo_virtual','file', array('label' => 'Company logo','required' => false))
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('howToApply',null, array('label' => 'How to apply?'))
            ->add('isPublic',null, array('label' => 'Public?'))
            ->add('email')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pr1\JobeetBundle\Entity\Job'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pr1_jobeetbundle_job';
    }
}
