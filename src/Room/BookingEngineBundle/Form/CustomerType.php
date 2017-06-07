<?php

namespace Room\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email','email')
            ->add('mobile')
            ->add('couponCode')
            
           // ->add('address','textarea')
        ;
   
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Room\BookingEngineBundle\Entity\Customer',
            'attr' => array('class' => 'bookform'),
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'room_bookingenginebundle_customer';
    }
}
