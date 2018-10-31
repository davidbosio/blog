<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PostType extends abstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', textType::class)
            ->add('cuerpo', textareaType::class)
            ->add('estado', textType::class)
            ->add('idUsuario', textType::class)
            ->add('submit', SubmitType::class, array(
                'label' => 'Publicar',
                'attr'  => array('class' => 'btn btn-default pull-right')
            ));
    }
}



?>