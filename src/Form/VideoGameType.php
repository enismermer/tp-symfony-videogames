<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Console;
use App\Entity\VideoGame;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
            ])
            ->add('developer', TextType::class, [
                'required' => true,
            ])
            ->add('releaseDate', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
                'html5' => true,
                'required' => true,
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name', // ou le champ à afficher
                'multiple' => true,
                'expanded' => true, // si tu veux des cases à cocher. Mets false pour une liste déroulante multiple.
                'required' => false,
            ])
            ->add('consoles', EntityType::class, [
                'class' => Console::class,
                'choice_label' => 'name', // ou autre champ
                'multiple' => true,
                'expanded' => true,
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VideoGame::class,
        ]);
    }
}
