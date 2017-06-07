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
 * This is a Form to collect the data of QuestionSearch in
 * StayBoat application.
 */
class ContactType extends AbstractType
{
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('name', null, array(
            		'required'    => true,
            		'label' => '',
            		'attr'   =>  array(
            				'placeholder'=>'Your Name'
            		),
            ))
            				
            ->add('email',null ,array(
            		                
            						'required'    => true,
            						'label' => '',
            		'attr'   =>  array(
            				'placeholder'=>'Your Email'
            		),
            						
            				))
            ->add('mobile', null ,array(
            		                
            						'required'    => true,
            						'label' => '',
            		'attr'   =>  array(
            				'placeholder'=>'Your Phone'
            		),
            				))
            ->add('subject', null ,array(
            		                
            						'required'    => true,
            						'label' => '',
            		'attr'   =>  array(
            				'placeholder'=>'Your Topic'
            		),
            				))
            
            
            				
            ->add('message','textarea',array('attr' => array('rows' => '7','placeholder'=>'How we can help you?'),
            						'required'  => true,
            				))
           
          
        ;
                    
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Room\SiteManagementBundle\Entity\Contact',
            'attr' => array('id'=>'hotel_contact','class'=>'contact-form default-form')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hotel_contact';
    }
}