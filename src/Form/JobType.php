<?php

namespace App\Form;

use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status')
            ->add('title')
            ->add('description')
            ->add('images')
            ->add('files')
            ->add('isRemote')
            ->add('isPermanent')
            ->add('permanentType')
            ->add('cityOther')
            ->add('citiesAllowed')
            ->add('salaryType')
            ->add('salaryCurrency')
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
            ->add('createdAt')
            ->add('updatedAt')
            //->add('category')
            //->add('city')
           // ->add('country')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
