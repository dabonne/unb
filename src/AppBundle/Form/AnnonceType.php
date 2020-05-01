<?php

namespace AppBundle\Form;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;


class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule',TextType::class,array(
                'label' =>'Objet'
            ))
            ->add('information', TextareaType::class, array(
                'attr' => array(
                    'id' => 'monId',
                    'rows' => '10',
                    'cols' => '200'
                )
                ))
            ->add('pieceFile',VichFileType::class, array(
                'label'=> false
            ))
            ->add('natures',EntityType::class,
                array(
                    'class'=>'AppBundle:Nature',
                    'multiple'=>true,
                    'choice_label'=>'intitule',
                    'label'=>'Concerne',
                    'placeholder'=>'choisir les formations ',
                    'attr'=>array('class'=>'select2Diplomes')
                )
            )
            ->add('dateFin',DateType::class, [
                'widget' => 'single_text',
                'label' => 'fin de l\'annonce'
            ])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_annonce';
    }


}
