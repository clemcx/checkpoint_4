<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\ArtGenre;
use App\Entity\ArtType;
use App\Entity\Work;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('creator')
            ->add('releaseDate')
            ->add('title')
            ->add('artType', null, [
                'attr' => ['class' => 'checkbox',
                    'data-live-search' => 'true'
                ],
                'class' => ArtType::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false
            ])
            ->add('artGenres', null, [
                'attr' => ['class' => 'selectpicker',
                    'data-live-search' => 'true'
                ],
                'class' => ArtGenre::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false
            ])
            ->add('actors', null, [
                'attr' => ['class' => 'selectpicker',
                    'data-live-search' => 'true'
                ],
                'class' => Actor::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Work::class,
        ]);
    }
}
