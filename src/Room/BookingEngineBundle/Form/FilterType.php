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

class FilterType extends AbstractType
{
	
	private $filters;
	
	public function __construct($filters)
	{
		$this->filters= $filters;
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getLocations()
	{
		$locations = $this->filters['locations'];
		return $locations;
	}
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getAmenities()
	{
		$amenities = $this->filters['amenities'];
		return $amenities;
	}
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	private function getCategories()
	{
		$categories = $this->filters['categories'];
		return $categories;
	}
	
     /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location', 'choice', array(
            		'expanded' => true,
            		'multiple' => true,
            		'choices' => $this->getLocations(),
            		'required'    => false,
            ))
          /*  ->add('amenities', 'choice', array(
            		'expanded' => true,
            		'multiple' => true,
            		'choices' => $this->getAmenities(),
            		'required'    => false,
            ))*/
            ->add('price')
            ->add('categories', 'choice', array(
            		'expanded' => true,
            		'multiple' => true,
            		'choices' => $this->getCategories(),
            		'required'    => false,
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
                'attr' => array('class' => 'default-form','id'=>'filter')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hotel_search_filter';
    }
}