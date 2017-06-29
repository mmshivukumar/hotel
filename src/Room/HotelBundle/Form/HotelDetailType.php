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
            ->add('propertyType', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'label' => 'Property Type',
            		'choices' => array(
            				'Service Apartments'=>'Service Apartments',
            				'Resort'=>'Resort',
            		),
            		'required'    => true,
            ))
            ->add('category', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'label' => 'Category',
            		'choices' => array(
            				'3'=>'3 Star',
            				'4'=>'4 Star',
            				'5'=>'5 Star',
            		),
            		'required'    => true,
            ))
            ->add('checkIn')
            ->add('checkOut')
            ->add('price')          
            ->add('numRooms')
            ->add('priority', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'label' => 'Priority',
            		'choices' => array(          				            				
            				'5'=>'5',
            				'4'=>'4',
            				'3'=>'3',
            				'2'=>'2',
            				'1'=>'1',
            		),
            		'required'    => true,
            ))
            ->add('soldOut', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'label' => 'Sold Out',
            		'choices' => array(
            				'0'=>'No',
            				'1'=>'Yes',
            				
            		),
            		'required'    => true,
            ))
            ->add('active', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
            		'label' => 'Status',
            		'choices' => array(
            				'1'=>'Active',
            				'0'=>'InActive',
            		),
            		'required'    => true,
            ))
            ->add('addressLine1')
            ->add('addressLine2')
            ->add('city')
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
