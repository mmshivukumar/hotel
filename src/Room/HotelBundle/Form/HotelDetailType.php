<?php

namespace Room\HotelBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HotelDetailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('overview')
            ->add('propertyType')
         	->add('category')
            ->add('checkIn')
            ->add('checkOut')
            ->add('price')
            ->add('city')
            ->add('numRooms')
            ->add('priority')
            ->add('soldOut')
            ->add('active')
            ->add('addressLine1')
            ->add('addressLine2')
            ->add('location')
            ->add('pincode')
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Room\HotelBundle\DTO\HotelDto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'room_hotelbundle_hoteldetail';
    }
}
