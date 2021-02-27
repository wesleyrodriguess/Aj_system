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
 * @Route("/Caixa")
 * @Template()
 */
class CaixaController extends Controller
{
    /**
     * @Route("/", name="caixa_index")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     * @Method({"POST", "GET"})
     */
    public function indexAction(Request $request)
    {

        $filter = new FilterServico();
        $formFilter = $this->createForm(FilterServicoType::class, $filter);
        $formFilter->handleRequest($request);

        $caixa = $this->getServicoService()->getCaixa();
        $aPagar = $this->getContaService()->getAPagar();
        $pago = $this->getContaService()->getPago();
        $caixaAtual = doubleval($caixa) - doubleval($pago);
        $receber = $this->getServicoService()->getReceber();
        $total = $this->getServicoService()->getTotal();

        $inicioMes = date("Y-m-01");
        $fimMes = date("Y-m-t");

        $inicioMes = explode('-', $inicioMes);
        $fimMes = explode('-', $fimMes);

        $inicioMes = new \DateTime(''.$inicioMes[0].'-'.$inicioMes[1].'-'.$inicioMes[2].'');
        $fimMes = new \DateTime(''.$fimMes[0].'-'.$fimMes[1].'-'.$fimMes[2].'');
        $caixaMensal = $this->getServicoService()->getCaixaMensal($inicioMes, $fimMes);

        if ($formFilter->isSubmitted() and $formFilter->isValid()) {
            $servicos = $this->getServicoService()
                ->getFilterServico(
                    $filter->getStatus(),
                    $filter->getDataDe(),
                    $filter->getDataAt(),
                    $filter->getCliente(),
                    $filter->getResponsavel(),
                    $filter->getNome(),
                    $filter->getSolicitante()
                );
            $caixaMensal = $this->getServicoService()->getCaixaMensal($filter->getDataDe(), $filter->getDataAt());

        }else {
            $servicos = $this->getDoctrine()
                ->getRepository(Servico::class)
                ->findServicoAll();
        }

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $servicos,
            $request->query->get('page', 1),
            10
        );
        return array(
            'servicos' => $pagination,
            'caixa' => $caixaAtual,
            'caixaMensal' => $caixaMensal,
            'receber' => $receber,
            'aPagar' => $aPagar,
            'total' => $total,
            'formFilter' => $formFilter->createView()
        );

    }
    private function getFuncionarioService()
    {
        return $this->get('ajsystem_admin.funcionario');
    }

    private function getServicoService()
    {
        return $this->get('ajsystem_admin.servico');
    }

    private function getContaService()
    {
        return $this->get('ajsystem_admin.conta');
    }

}

