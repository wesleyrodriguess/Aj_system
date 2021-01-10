<?php

namespace AjSystem\AdminBundle\Form;

use AjSystem\AdminBundle\Entity\Servico;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AjSystem\AdminBundle\Entity\Funcionario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, array('label' => 'Nome'))
            ->add('solicitante', TextType::class, array('label' => 'Solicitante'))
            ->add('status', ChoiceType::class, array(
                'label' => 'status',
                'placeholder' => '',
                'choices' => [
                    'Pago' => 1,
                    'A Receber' => 2,
                ],
            ))
            ->add('responsavel', EntityType::class, [
                'label' => 'Funcionario',
                'placeholder' => 'Selecione um Responsavel',
                'class' => 'AjSystem\AdminBundle\Entity\Funcionario',
                'choice_label' => 'nome'
            ])
            ->add('cliente', EntityType::class, [
                'label' => 'Cliente',
                'placeholder' => 'Selecione um Cliente',
                'class' => 'AjSystem\AdminBundle\Entity\Cliente',
                'choice_label' => 'nome'
            ])
            ->add('dataFinalizacao', DateType::class, array(
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'widget' => 'single_text',
                'label' => 'Data',
                'mapped' => false,
                'attr' => ['class' => 'datepicker']
            ))
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
            'data_class' => Servico::class
        ));
    }

    public function getBlockPrefix()
    {
        return 'servico';
    }


}
