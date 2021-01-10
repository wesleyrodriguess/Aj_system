<?php

namespace AjSystem\AdminBundle\Controller;

use AjSystem\AdminBundle\Entity\ContasAPagar;
use AjSystem\AdminBundle\Entity\Filter\FilterContasAPagar;
use AjSystem\AdminBundle\Entity\Servico;
use AjSystem\AdminBundle\Form\ContasAPagarType;
use AjSystem\AdminBundle\Form\Filter\FilterContasAPagarType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/contas_pagar")
 * @Template()
 */
class ContasPagarController extends Controller
{
    /**
     * @Route("/", name="conta_pagar_index")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function indexAction(Request $request)
    {

        $filter = new FilterContasAPagar();
        $formFilter = $this->createForm(FilterContasAPagarType::class, $filter);
        $formFilter->handleRequest($request);

        if ($formFilter->isSubmitted() and $formFilter->isValid()) {
            $contas = $this->getContasService()
                ->getFilterConta(
                    $filter->getStatus(),
                    $filter->getDataDe(),
                    $filter->getDataAt(),
                    $filter->getTipo(),
                    $filter->getFuncionario()
                );
        }else {
            $contas = $this->getDoctrine()
                ->getRepository(ContasAPagar::class)
                ->findContaAll();
        }

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $contas,
            $request->query->get('page', 1),
            10
        );
        return array(
            'contas' => $pagination,
            'formFilter' => $formFilter->createView()
        );

    }

    /**
     * @Route("/new", name="novo_conta_pagar")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function newAction(Request $request)
    {
        $conta = new ContasAPagar();

        $form = $this->createForm(ContasAPagarType::class, $conta);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();

                if ($form->getData()->isStatus() === null){
                    $conta->setStatus(2);
                }
                $em->persist($conta);
                $em->flush();
                $this->addMensagemSucesso('Despesa cadastrado com sucesso');
            } catch (\Exception $e) {
                $this->addMensagemErro("Erro ao Registrar Despesa");
            }

            return $this->redirectToRoute('conta_pagar_index');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="editar_conta_pagar")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function editAction(ContasAPagar $contasAPagar, Request $request)
    {
        $form = $this->createForm(ContasAPagarType::class, $contasAPagar);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()){
            try {

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $this->addMensagemSucesso('Despesa Atualizado com sucesso');
            } catch (\Exception $e) {
                $this->addMensagemErro("Erro ao atualizar o DEspesa");
            }

            return $this->redirectToRoute('conta_pagar_index');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="deletar_conta_pagar")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function deleteAction(ContasAPagar $contasAPagar)
    {
        try {

            $contasAPagar->setStatus(0);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addMensagemSucesso('Despesa Cancelado sucesso');
        } catch (\Exception $e) {
            $this->addMensagemErro("Erro ao Cancelar Despesa");
        }

        return $this->redirectToRoute('conta_pagar_index');
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

    private function formartValor($valor){
        if (strpos($valor, 'R$') == false) {
            $valor = str_replace('R$', '', $valor);
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
            $valor = (float) number_format((float) $valor, 2, '.', '');
        }
        return $valor;
    }
    private function getFuncionarioService()
    {
        return $this->get('ajsystem_admin.funcionario');
    }

    private function getContasService()
    {
        return $this->get('ajsystem_admin.conta');
    }

    private function getClienteService()
    {
        return $this->get('ajsystem_admin.cliente');
    }

}

