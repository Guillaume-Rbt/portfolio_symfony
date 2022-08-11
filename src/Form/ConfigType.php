<?php

namespace App\Form;

use App\Entity\Config;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Config\FosCkEditorConfig;

class ConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class , [
                'label' => "Nom",
                'attr' => ["placeholder" => 'Dupont', 'class' => 'mt-2']
            ])
            ->add('firstname', TextType::class , [
                'label' => "Prénom",
                'attr' => ["placeholder" => 'Jean' , 'class' => 'mt-2']
            ])
            ->add('birthDate', TextType::class,[
                'label' => "Date de naissance",
                'attr' => ["placeholder" => '15/06/1995' , 'class' => 'mt-2']
            ])
            ->add('description', CKEditorType::class)
            ->add('phone', TextType::class, [
                'label' => "Numéro de téléphone",
                'attr' => ["placeholder" => '0605021416' , 'class' => 'mt-2']
            ])
            ->add('email', TextType::class,['required'=>false])
            ->add('linkedin_link', UrlType::class, [
                'label' => "Lien Linkedin", 
                'attr' => ["class" => 'mt-2']
            ])
            ->add('github_link', UrlType::class, [
                'label' => "Lien github",
                'attr' => ["class" => 'mt-2']
            ])
            ->add('photo', FileType::class, ['label' => 'Photo', "mapped" => false])
            ->add('CV', FileType::class, ['label' => 'Curriculum Vitae', "mapped" => false])
            ->add("submit", SubmitType::class, [
                'label' => "Enregistrer", 
                'attr' => ["class" => 'mt-4 btn btn-primary']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Config::class,
        ]);
    }
}
