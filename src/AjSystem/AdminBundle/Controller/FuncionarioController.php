<?php

namespace AjSystem\AdminBundle\Controller;

use AjSystem\AdminBundle\Entity\Funcionario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/funcionarios")
 * @Template()
 */
class FuncionarioController extends Controller
{
    /**
     * @Route("/", name="funcionario_index")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function indexAction(Request $request)
    {
        $funcionarios = $this->getDoctrine()
            ->getRepository(Funcionario::class)
            ->findBy(['active' => true]);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $funcionarios,
            $request->query->get('page', 1),
            10
        );
        return array(
            'funcionarios' => $pagination
        );

    }

    /**
     * @Route("/new", name="novo_funcionario")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function newAction(Request $request)
    {

    }

    /**
     * @Route("/edit/{id}", name="editar_funcionario")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function editAction(Funcionario $funcionario, Request $request)
    {

    }

    /**
     * @Route("/delete", name="deletar_funcionario")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function deleteAction(Funcionario $funcionario)
    {

    }
}

