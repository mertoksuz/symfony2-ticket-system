<?php

namespace Mert\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('category', 'entity', array('class' => 'Mert\TicketBundle\Entity\Category'));
        $builder->add('title', 'text', array('label' => false));
        $builder->add('content', 'textarea', array('label' => false));
        $builder->add('priority', 'choice',
            array('choices' =>
                array(1 => "Low", 2 => "Normal", 3 => "High")
            )
        );
        $builder->add('file', 'file');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mert\TicketBundle\Entity\Ticket',
        ));
    }

    public function getName()
    {
        return 'mert_ticket_bundle_ticket_type';
    }
}
