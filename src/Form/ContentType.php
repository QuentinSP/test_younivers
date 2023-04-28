<?php

namespace App\Form;

use App\Entity\Content;
use App\Entity\ContentSector;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content_sector', EntityType::class, [
                'class' => ContentSector::class,
                'choice_label' => function(ContentSector $contentSector) {
                    return sprintf('%s', $contentSector->getNom());
                }
            ])
            ->add('title')
            ->add('description')
            ->add('images', FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}
