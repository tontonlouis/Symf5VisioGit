<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
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
