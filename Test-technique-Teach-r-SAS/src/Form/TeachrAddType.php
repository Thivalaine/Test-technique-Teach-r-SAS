<?php

namespace App\Form;

use App\Entity\Teachr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class TeachrAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champs ne peut pas être vide !',
                    ])
                ],
            ])
            ->add('formation', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champs ne peut pas être vide !',
                    ])
                ],
            ])
            ->add('description', TextAreaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champs ne peut pas être vide !',
                    ])
                ],
            ])
            ->add('image', FileType::class, [
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'maxSizeMessage' => 'Le fichier est trop lourd ({{ size }} kB). Le maximum alloué est de 2048 kB',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                            'image/svg',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Mettez un fichier en format (jpg, png, jpeg, gif, svg)',
                    ])
                ],
            ])
            ->add('date_creation', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teachr::class,
        ]);
    }
}
