<?php

namespace AjSystem\AdminBundle\Form;

use AjSystem\AdminBundle\Entity\Cliente;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, array('label' => 'Nome'))
            ->add('email', EmailType::class, array(
                'label' => 'E-mail',
                'required' => true
            ))
            ->add('telefone', TelType::class, array(
                'label' => 'Telefone para contato',
                'required' => false,
                'attr' => ['class' => 'phone-mask']
            ))
            ->add('cidade', TextType::class, array('label' => 'Cidade'))
            ->add('estado', TextType::class, array('label' => 'Estado'))
            ->add('cep', TextType::class, array(
                'label' => 'Cep',
                'attr' => ['class' => 'cep-mask']
            ))
            ->add('bairro', TextType::class, array('label' => 'bairro'))
            ->add('logradouro', TextType::class, array('label' => 'Logradouro'))
            ->add('numero', TextType::class, array('label' => 'Numero'))
            ->add('cpfAndCnpj', TextType::class, array(
                'label' => 'CPF/CNPJ'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Cliente::class
        ));
    }

    public function getBlockPrefix()
    {
        return 'cliente';
    }


}
