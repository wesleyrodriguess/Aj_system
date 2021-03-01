<?php

namespace AjSystem\AdminBundle\Form;

use AjSystem\AdminBundle\Entity\ContasAPagar;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContasAPagarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, array('label' => 'Nome'))
            ->add('descricao', TextType::class, array('label' => 'Descrição'))
            ->add('status', ChoiceType::class, array(
                'label' => 'status',
                'placeholder' => '',
                'choices' => [
                    'Pago' => 1,
                    'A Pagar' => 2,
                ],
            ))
            ->add('dataPago', DateType::class, [
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'widget' => 'single_text',
                'label' => 'Data Pago',
                'required' => false,
                'attr' => ['class' => 'datepicker', 'autocomplete' => 'off']
            ])
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
            ->add('funcionario', EntityType::class, [
                'label' => 'Funcionario',
                'placeholder' => 'Selecione um Funcionario',
                'class' => 'AjSystem\AdminBundle\Entity\Funcionario',
                'choice_label' => 'nome'
            ])
            ->add('valor', TextType::class, [
                'label' => 'Valor do serviço',
                'attr' => ['class' => 'money-mask'],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ContasAPagar::class
        ));
    }

    public function getBlockPrefix()
    {
        return 'contas_a_pagar';
    }


}
