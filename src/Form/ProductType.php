<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [

                'label' => 'Nom du produit :'
            ])
            ->add('description', TextareaType::class, [

                'label' => 'Description du produit :'
            ])
            ->add('imageFile',
                VichImageType::class, [
                    'allow_delete' => false,
                    'download_link' => false,
                    'required'=> false,
                    'label' => 'Photo du produit :'
                    ])
            ->add('price',MoneyType::class, [
                'label' => 'Prix du produit :'

            ])
            ->add('category', null, [
                'required' => true,
                'choice_label' => 'name',
                'label' => 'Catégorie du produit :'
            ])
        ;
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'required_image' => false,
        ]);
    }
}
