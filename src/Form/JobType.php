<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('title', null, [
                'required'   => true,
                'data' => 'What needs to be done',
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ])
            ->add('images')
            ->add('isRemote')
            ->add('isPermanent')
            ->add('permanentType')
            ->add('cityOther')
            ->add('citiesAllowed')
            ->add('salaryType')
            ->add('salaryCurrency')
            ->add('salaryCurrency', ChoiceType::class, [
                'choices'  => [
                    'USD'=> 1,
                    'EUR' => 2,
                    'UAH' => 3,
                ],
            ])
            ->add('salary')
            ->add('salaryPayMethod')
            ->add('salaryComment')
            ->add('salaryRange')
            ->add('salaryRangeFrom')
            ->add('salaryRangeTo')
            ->add('experienceNumber')
            ->add('experienceDimension')
            ->add('seekPeriod')
            ->add('seekPeriodDimension')
            ->add('education')
            ->add('ageFrom')
            ->add('ageTo')
            ->add('skills')
            ->add('languages')
           // ->add('category', EntityType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title_uk',
            ])
            //->add('city')
           // ->add('country')
            //->add('user')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            // ... add a choice list of friends of the current application user
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
