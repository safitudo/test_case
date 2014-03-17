<?php

namespace GuestBook\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GuestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(	'name', 'text', 
	        		array( 'attr' => array(
						'placeholder' => 'Name',
					)))
	        ->add(	'email', 'text',
	        		array( 'attr' => array(
						'placeholder' => 'Email',
					)))
	        ->add('save', 'submit');
    }

    public function getName()
    {
        return 'guest';
    }
}