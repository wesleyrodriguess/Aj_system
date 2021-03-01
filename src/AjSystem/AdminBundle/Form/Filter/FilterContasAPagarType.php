<?php

namespace AjSystem\AdminBundle\Form\Filter;

use AjSystem\AdminBundle\Entity\Filter\FilterContasAPagar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterContasAPagarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, array(
                'label' => 'Nome',
                'required' => false,
                'attr' => ['placeholder' => 'Nome do Serviços']
            ))
            ->add('tipo', ChoiceType::class, array(
                'label' => 'Tipo de Conta',
                'required' => false,
                'placeholder' => 'Selecione o Tipo de conta',
                'choices' => [
                    'Internet' => 'internet',
                    'Salario' => 'salario',
                    'Conta de luz' => 'luz',
                    'Conta de agua' => 'agua',
                    'Outros' => 'outros',
                ],
            ))
            ->add('status', ChoiceType::class, array(
                'label' => 'Status',
                'placeholder' => '',
                'choices' => [
                    'Paga' => 1,
                    'A Pagar' => 2,
                    'Cancelada' => 0,
                ],
            ))
            ->add('funcionario', EntityType::class, [
                'label' => 'Funcionario',
                'placeholder' => 'Selecione um Funcionario',
                'class' => 'AjSystem\AdminBundle\Entity\Funcionario',
                'choice_label' => 'nome'
            ])
            ->add('dataDe', DateType::class, array(
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'label' => 'Data Inicio',
                'widget' => 'single_text',
                'attr' => ['class' => 'datepicker','autocomplete' => 'off']
            ))
            ->add('dataAt', DateType::class, array(
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'widget' => 'single_text',
                'label' => 'Data Fim',
                'attr' => ['class' => 'datepicker','autocomplete' => 'off']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FilterContasAPagar::class,
            'method' => 'GET'
        ));
    }

}
