<?php

namespace AjSystem\AdminBundle\Controller;

use AjSystem\AdminBundle\Entity\Caixa;
use AjSystem\AdminBundle\Entity\Filter\FilterServico;
use AjSystem\AdminBundle\Entity\Servico;
use AjSystem\AdminBundle\Form\Filter\FilterServicoType;
use AjSystem\AdminBundle\Form\ServicoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/Servico")
 * @Template()
 */
class ServicoController extends Controller
{
    /**
     * @Route("/", name="servico_index")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function indexAction(Request $request)
    {

        $filter = new FilterServico();
        $formFilter = $this->createForm(FilterServicoType::class, $filter);
        $formFilter->handleRequest($request);

        if ($formFilter->isSubmitted() and $formFilter->isValid()) {
            $servicos = $this->getServicoService()
                ->getFilterServico($filter->getNome());
        }else {
            $servicos = $this->getDoctrine()
                ->getRepository(Servico::class)
                ->findAll();
        }

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $servicos,
            $request->query->get('page', 1),
            10
        );
        return array(
            'servicos' => $pagination,
            'formFilter' => $formFilter->createView()
        );

    }

    /**
     * @Route("/new", name="novo_servico")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function newAction(Request $request)
    {
        $servicos = new Servico();

        $form = $this->createForm(ServicoType::class, $servicos);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                if ($form->getData()->isStatus() === null){
                    $servicos->setStatus(2);
                }
                $em->persist($servicos);
                $em->flush();
                $this->addMensagemSucesso('Serviço cadastrado com sucesso');
            } catch (\Exception $e) {
                $this->addMensagemErro("Erro ao Registrar Serviço");
            }

            return $this->redirectToRoute('servico_index');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="editar_servico")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function editAction(Servico $servico, Request $request)
    {
        $form = $this->createForm(ServicoType::class, $servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()){
            try {

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $this->addMensagemSucesso('Serviço Atualizado com sucesso');
            } catch (\Exception $e) {
                $this->addMensagemErro("Erro ao atualizar o Serviço");
            }

            return $this->redirectToRoute('servico_index');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="deletar_servico")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function deleteAction(Servico $servico)
    {
        try {

            $servico->setStatus(0);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addMensagemSucesso('Servico Cancelado sucesso');
        } catch (\Exception $e) {
            $this->addMensagemErro("Erro ao Cancelar Servico");
        }

        return $this->redirectToRoute('servico_index');
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

    private function getServicoService()
    {
        return $this->get('ajsystem_admin.servico');
    }

    private function getClienteService()
    {
        return $this->get('ajsystem_admin.cliente');
    }

}

