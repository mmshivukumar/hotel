<?php

namespace Room\BookingEngineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerId')
            ->add('bookingId')
            ->add('totalPrice')
            ->add('discount')
            ->add('finalPrice')
            ->add('serviceTax')
            ->add('swachBharthCess')
            ->add('krishiKalyanCess')
            ->add('amountPaid')
            ->add('paymentId')
            ->add('couponCode')
            ->add('couponApplyed')
            ->add('numDays')
            ->add('numAdult')
            ->add('numRooms')
            ->add('chekIn')
            ->add('chekOut')
            ->add('status')
            ->add('jobStatus')
            ->add('bookedOn')
            ->add('paymentMode')
            ->add('hotelId')
            ->add('hotelName')
            ->add('location')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Room\BookingEngineBundle\Entity\Booking'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'room_bookingenginebundle_booking';
    }
}
