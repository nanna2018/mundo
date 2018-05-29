<?php

namespace App\Form;

use App\Entity\Presidente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Pais;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PresidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              
            ->add('nombre')
            ->add('fechanac')
            ->add('pais',EntityType::class,array(
              'class' => Pais::class,
              'choice_label' => function ($pais) {
                  return $pais->getNombre();
          }))
             ->add('save', SubmitType::class, array(
             'attr' => array('class' => 'btn btn-success'),
            ))
             

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presidente::class,
        ]);
    }
}
