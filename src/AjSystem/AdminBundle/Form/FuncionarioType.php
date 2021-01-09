<?php

namespace AjSystem\AdminBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AjSystem\AdminBundle\Entity\Funcionario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FuncionarioType extends AbstractType
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Funcionario::class
        ));
    }

    public function getBlockPrefix()
    {
        return 'funcionario';
    }


}
