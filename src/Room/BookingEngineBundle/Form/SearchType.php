<?php

namespace Room\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Event\DataEvent;

class SearchType extends AbstractType
{
	
	private $catalogueService;
	
	public function __construct($catalogueService)
	{
		$this->catalogueService= $catalogueService;
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getCities()
	{
		$cities = $this->catalogueService->getCities();
		$tempCities = array();
		foreach ($cities as $city){
             if($city->getActive()){
		          $tempCities[$city->getId()] = $city->getName();
             }
		}
		return $tempCities;
	}
	
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', 'choice', array(
            		'expanded' => false,
            		'multiple' => false,
                    'data'=>1,
            		'choices' => $this->getCities(),
            		'required'    => true,
            		'empty_value'   => 'Select Origin',
                    'attr'   =>  array(
                                        'class'=>'chosen-select',
                                        'data-style'=>'btn-white',
                                        'data-live-search'=>'true',
                                        'data-placeholder'=>'Select City, Location or Hotel Name'
				            		),
            ))
           
            ->add('checkIn','date',array(
            						'required'    => true,
            						'label' => 'Check In',
                				    'widget'=> 'single_text',
						            'format'=>'d/M/y',
				            		'attr'   =>  array(
				            				'data-date-format'=>'dd/mm/yyyy',
				            				'data-dateformat'=>"d/m/y",
                                            'placeholder'=>'Check In',
				            				//'class'=>'hasDatepicker'
				            		),
            		
            				))
            ->add('checkOut','date',array(            						
            						'required'    => false,
            						'label' => 'Check Out',
            						'read_only' => true,
                				   'widget'=> 'single_text',
						           'format'=>'d/M/y',
            						'attr'   =>  array(
            								'data-date-format'=>'dd/mm/yyyy',
            								'data-dateformat'=>"d/m/y",
                                            'placeholder'=>'Check Out',
            								//'class'=>'hasDatepicker'
            						),
            		            
            				))   
            ->add('numAdult','hidden',array(            						
            						'required'    => true,
            						'label' => 'No of Adult',
                                   // 'data'=>'2',
            						'attr'   =>  array(
                                            'placeholder'=>'Number of Adult'
            						),
            		            
            				))
            ->add('numRooms','hidden',array(
            						'required'    => true,
            						'label' => 'No of Adult',
            						//'data'=>'1',
            						'attr'   =>  array(
            								'placeholder'=>'Number of Adult'
            						),
            				
            				))
            ->add('numChildren','hidden',array(
            						'required'    => true,
            						'label' => 'No of Children',
            						'data'=>'0',
            						'attr'   =>  array(
            								'placeholder'=>'Number of Children'
            						),
            				
            		))            
        ;
        
                          
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        		'data_class' => 'Room\BookingEngineBundle\DTO\Search',
        		'csrf_protection'   => false,
        		'allow_extra_fields' => true,
                'attr' => array('class' => 'default-form','id'=>'search')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hotel_search';
    }
}