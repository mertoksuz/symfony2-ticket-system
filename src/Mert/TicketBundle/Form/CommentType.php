<?php

namespace Mert\TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ticketId', 'entity' , array('class' => 'Mert\TicketBundle\Entity\Ticket'));
        $builder->add('comment', 'textarea', array('label' => false));
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
