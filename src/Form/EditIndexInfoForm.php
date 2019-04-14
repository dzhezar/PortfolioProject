<?php


namespace App\Form;


use App\DTO\EditIndexInfoForm as EditIndexInfoFormDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditIndexInfoForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'mainImg1',
                FileType::class,
                ['required' => false])
            ->add(
                'mainImg2',
                FileType::class,
                ['required' => false])
            ->add(
                'mainImg3',
                FileType::class,
                ['required' => false])
            ->add(
                'aboutLina',
                TextareaType::class,
                ['attr' => ['rows' => 3]])
            ->add(
                'aboutKatya',
                TextareaType::class,
                ['attr' => ['rows' => 3]])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditIndexInfoFormDto::class,
        ]);
    }

}