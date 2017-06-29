<?php

namespace Room\SiteManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Event\DataEvent;
/**
 * This is a Form to Search the booking data
 */
class BookingSearchType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from',null,array(
            						'required'    => false,
            						'label' => 'From Date',
            						'data'  => date('d/m/Y'),
            						'attr'=>array('class'=>'hasDatepicker calendar')
            				))
            ->add('to',null,array(
            						'required'    => false,
            						'label' => 'To Date',
            						'data'  => date('d/m/Y'),
            						'attr'=>array('class'=>'hasDatepicker calendar')
            				))
        ;
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Room\SiteManagementBundle\DTO\BookingSearch'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'room_booking_search';
    }
}