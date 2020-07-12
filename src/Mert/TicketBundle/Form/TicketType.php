<?php

namespace Mert\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('category', EntityType::class, array('class' => 'Mert\TicketBundle\Entity\Category'));
        $builder->add('title', TextType::class, array('label' => false));
        $builder->add('content', TextareaType::class, array('label' => false));
        $builder->add('priority', ChoiceType::class,
            array('choices' =>
                array(1 => "Low", 2 => "Normal", 3 => "High")
            )
        );
        $builder->add('file', FileType::class);
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
