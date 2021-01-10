<?php

namespace AjSystem\AdminBundle\Controller;

use AjSystem\AdminBundle\Entity\Cliente;
use AjSystem\AdminBundle\Entity\Filter\FilterCliente;
use AjSystem\AdminBundle\Form\ClienteType;
use AjSystem\AdminBundle\Form\Filter\FilterClienteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/cliente")
 * @Template()
 */
class ClienteController extends Controller
{
    /**
     * @Route("/", name="cliente_index")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function indexAction(Request $request)
    {

        $filter = new FilterCliente();
        $formFilter = $this->createForm(FilterClienteType::class, $filter);
        $formFilter->handleRequest($request);

        if ($formFilter->isSubmitted() and $formFilter->isValid()) {
            $clientes = $this->getClienteService()
                ->getFilterCliente($filter->getNome(), $filter->getEmail(), $filter->getCpfAndCnpj());
        }else {
            $clientes = $this->getDoctrine()
                ->getRepository(Cliente::class)
                ->findBy(['active' => true]);
        }

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $clientes,
            $request->query->get('page', 1),
            10
        );
        return array(
            'clientes' => $pagination,
            'formFilter' => $formFilter->createView()
        );

    }

    /**
     * @Route("/new", name="novo_cliente")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function newAction(Request $request)
    {
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
           // try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($cliente);
                $em->flush();

               // $this->addMensagemSucesso('Cliente cadastrado com sucesso');
          //  } catch (\Exception $e) {
             //   $this->addMensagemErro("Erro ao cadastrar Cliente");
          //  }

            return $this->redirectToRoute('cliente_index');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/edit/{id}", name="editar_cliente")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function editAction(Cliente $cliente, Request $request)
    {
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()){
            try {
                $em = $this->getDoctrine()->getManager();

                $em->flush();

                $this->addMensagemSucesso('Cliente Atualizado com sucesso');
            } catch (\Exception $e) {
                $this->addMensagemErro("Erro ao atualizar Cliente");
            }

            return $this->redirectToRoute('cliente_index');
        }

        return [
            'form' => $form->createView()
        ];
    }

    /**
     * @Route("/delete/{id}", name="deletar_cliente")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function deleteAction(Cliente $cliente)
    {

        try {

            $cliente->setActive(false);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addMensagemSucesso('Cliente Deletado sucesso');
        } catch (\Exception $e) {
            $this->addMensagemErro("Erro ao Deletar Cliente");
        }

        return $this->redirectToRoute('cliente_index');
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

    private function getClienteService()
    {
        return $this->get('ajsystem_admin.cliente');
    }

}

