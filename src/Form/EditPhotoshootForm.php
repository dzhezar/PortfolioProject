<?php


namespace App\Form;


use App\DTO\EditPhotoshootForm as EditPhotoshootFormDto;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPhotoshootForm extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('category', ChoiceType::class, [
                'choices'  => $this->getCategories(),
                'choice_label' => function ($category) {
                    /* @var Category $category */
                    return $category->getName();
                },
            ])
            ->add('shortDescription', TextType::class)
            ->add(
                'description',
                TextareaType::class,
                ['attr'=>['rows'=> 7]]
            )
            ->add('photographer', TextType::class)
            ->add('model', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EditPhotoshootFormDto::class,
        ]);
    }

    private function getCategories()
    {
        return $this->em->getRepository(Category::class)->findAll();
    }
}