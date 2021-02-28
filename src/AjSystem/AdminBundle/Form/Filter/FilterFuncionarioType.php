<?php

namespace AjSystem\AdminBundle\Form\Filter;

use AjSystem\AdminBundle\Entity\Filter\FilterFuncionario;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterFuncionarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, array(
                'required' => false,
                'attr' => ['placeholder' => 'Nome']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FilterFuncionario::class,
            'method' => 'GET'
        ));
    }

}
