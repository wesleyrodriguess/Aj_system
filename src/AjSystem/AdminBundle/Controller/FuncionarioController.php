<?php

namespace AjSystem\AdminBundle\Controller;

use AjSystem\AdminBundle\Entity\Funcionario;
use AjSystem\AdminBundle\Form\FuncionarioType;
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
        $funcionario = new Funcionario();
        $form = $this->createForm(FuncionarioType::class, $funcionario);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();

                $password = $this->get('security.password_encoder')->encodePassword($funcionario, '123456');
                $funcionario->setPassword($password);
                $funcionario->setRoles("ROLE_FUNCIONARIO");
                $funcionario->setActive(true);
                $em->persist($funcionario);
                $em->flush();

                $this->addMensagemSucesso('Funcionario cadastrado com sucesso');
            } catch (\Exception $e) {
                $this->addMensagemErro("Erro ao cadastrar Funcionario");
            }

            return $this->redirectToRoute('funcionario_index');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="editar_funcionario")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function editAction(Funcionario $funcionario, Request $request)
    {
        $form = $this->createForm(FuncionarioType::class, $funcionario);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()){
            try {
                $em = $this->getDoctrine()->getManager();

                $password = $this->get('security.password_encoder')->encodePassword($funcionario, $funcionario->getPassword());
                $funcionario->setPassword($password);
                $em->flush();

                $this->addMensagemSucesso('Funcionario Atualizado com sucesso');
            } catch (\Exception $e) {
                $this->addMensagemErro("Erro ao atualizar Funcionario");
            }

            return $this->redirectToRoute('funcionario_index');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="deletar_funcionario")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function deleteAction(Funcionario $funcionario)
    {

        try {

            $funcionario->setActive(false);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addMensagemSucesso('Funcionario Deletado sucesso');
        } catch (\Exception $e) {
            $this->addMensagemErro("Erro ao Deletar o Funcionario");
        }

        return $this->redirectToRoute('funcionario_index');
    }

    /**
     * @param $message
     */
    private function addMensagemErro($message)
    {
        $this->get('session')->getFlashBag()->add('error', $message);
    }

    /**
     * @param $message
     */
    private function addMensagemSucesso($message)
    {
        $this->get('session')->getFlashBag()->add('success', $message);
    }
}

