<?php

namespace App\Form;

use App\Entity\Localidad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Provincia;

class LocalidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('area')
            ->add('habitantes')
            ->add('cp')
            ->add('provincia',EntityType::class,array(
              'class' => Provincia::class,
              'choice_label' => function ($provincia) {
                  return $provincia->getNombre();
          }))
             ->add('save', SubmitType::class, array(
             'attr' => array('class' => 'btn btn-success'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Localidad::class,
        ]);
    }
}
