<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Job;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;

class JobTypeSearch extends AbstractType
{

    private $categoryRepository;
    
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isPermanent', ChoiceType::class, [
                'choices'  =>  array_flip(Job::getPermanentList()),
                 'required'  =>  false,
            ])


            ->add('salary_from', null, [
                'mapped' => false,
            ])

            ->add('salary_to', null, [
                'mapped' => false,
            ])

          /*  ->add('search_category', null, [
                'mapped' => false,
            ])*/


            ->add('salaryCurrency', ChoiceType::class, [
                'choices'  => array_flip(Job::getCurrencyList()),
                'required'  =>  false,
                'data' => 0
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
