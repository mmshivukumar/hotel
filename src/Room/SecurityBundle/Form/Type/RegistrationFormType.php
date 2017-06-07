<?php

namespace Room\SecurityBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
/**
 * This is a Form to collect the data of RegistrationForm to remove username in
 */
class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
       // $builder->add('name');
	    $builder->remove('username');  // we use email as the username
       /*  $builder->add('captcha', 'captcha', array(
            'width' => 150,
            'height' => 50,
            'length' => 6,
            'reload'=>'true',
            'as_url'=>'true',
        	'distortion'=>false,
        	'max_front_lines'=>0,
        	'max_behind_lines'=>0,
        	'interpolation'=>false,
        	'gc_freq'=>0,
        )); */
		
      
    }

    public function getName()
    {
        return 'room_registration';
    }
}