<?php

namespace Mert\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ticketId', EntityType::class, array('class' => 'Mert\TicketBundle\Entity\Ticket'));
        $builder->add('comment', TextareaType::class, array('label' => false));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mert\TicketBundle\Entity\Comment',
        ));
    }

    public function getName()
    {
        return 'mert_ticket_bundle_comment_type';
    }
}
