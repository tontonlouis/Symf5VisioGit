<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "required" => false,
                "attr" => [
                    'placeholder' => "Saississez le nom du bien"
                ]
            ])
            ->add('description', TextareaType::class, [
                "required" => false
            ])
            ->add('surface', IntegerType::class, [
                "required" => false
            ] )
            ->add('room', IntegerType::class, [
                "required" => false
            ])
            ->add('floor', IntegerType::class, [
                "required" => false
            ])
            ->add('price', IntegerType::class, [
                "required" => false
            ])
            ->add('address', TextType::class, [
                "required" => false
            ])
            ->add('city', TextType::class, [
                "required" => false
            ])
            ->add('postalCode', TextType::class, [
                "required" => false
            ])
            ->add('sold')
            ->add('pictureFiles', FileType::class, [
                'required' => false,
                'multiple' => true
            ])
            ->add('options', EntityType::class, [
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true,
                'required' => false,
            ])
            ->add('lat', HiddenType::class)
            ->add('lng', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }
}
