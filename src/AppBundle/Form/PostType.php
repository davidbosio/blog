<?php
namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class PostType extends abstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', textType::class)
            ->add('cuerpo', TextareaType::class)
            ->add('estado', EntityType::Class, array(
                'class' => 'AppBundle:Categoria',
                'choice_label' => 'descripcion',
                'attr' => array('class' => 'custom-select d-block w-100 col-md-4 mb-3' ),
            ))
            ->add('Enviar', SubmitType::class);
    }
}



?>