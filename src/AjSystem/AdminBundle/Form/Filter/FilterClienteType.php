<?php

namespace AjSystem\AdminBundle\Form\Filter;

use AjSystem\AdminBundle\Entity\Filter\FilterCliente;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, array(
                'label' => 'Nome',
                'required' => false
            ))
            ->add('email', TextType::class, array(
                'label' => 'E-mail',
                'required' => false
            ))
            ->add('cpfAndCnpj', TextType::class, array(
                'label' => 'CPF/CNPJ',
                'required' => false
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FilterCliente::class,
            'method' => 'GET'
        ));
    }

}
