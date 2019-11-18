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

class JobType extends AbstractType
{

    private $categoryRepository;
    
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
            ])
            ->add('description', TextareaType::class, [
            ])

            ->add('uploadedFiles', FileType::class, [
                'label' => 'job_files_label',
                'data_class' => null,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
//                'attr' => [
//                    'multiple' => 'multiple',
//                ],
//                'constraints' => [
//                    new File([
//                        'maxSize' => '1024k',
//                        'mimeTypes' => [
//                            'application/pdf',
//                            'application/x-pdf',
//                            'image/jpeg/',
//                            'image/png/',
//                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
//                            'application/msword',
//                            'text/plain',
//                        ],
//                        'mimeTypesMessage' => 'Wrong file format',
//                    ])
//                ],

                'label_translation_parameters' => [
                    'job_files_label' => 'Files (Project specification, images, etc)',
                ],
            ])


            ->add('isPermanent', ChoiceType::class, [
                'choices'  =>  array_flip(Job::getPermanentList()),
                'label' => 'job_permanent_label',
                'choice_translation_domain' => 'messages',
            ])


            ->add('salary')

            ->add('salaryCurrency', ChoiceType::class, [
                'choices'  => array_flip(Job::getCurrencyList()),
            ])

            ->add('salaryType', ChoiceType::class, [
                'choices'  => array_flip(Job::getSalaryTypeList()),
                'label' => 'job_salary_type',
                'choice_translation_domain' => 'messages',
            ])

            ->add('main_category', EntityType::class, [
                'class' => Category::class,
                'mapped' => false,
                'choice_label' => 'title_' . $GLOBALS['request']->getLocale(),
                'choices' => $this->categoryRepository->findMainCategories(),
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title_' . $GLOBALS['request']->getLocale(),
                //'attr' => ['style' => 'display:none;'],
                'label' => false,
                'choices' => null,
            ])


            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
               'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms',
                    ]),
                ],
                'translation_domain' => 'messages',
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
