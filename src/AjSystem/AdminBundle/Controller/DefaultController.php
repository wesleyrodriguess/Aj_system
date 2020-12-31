<?php

namespace AjSystem\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController
 * @Template()
 * @package AjSystem\AdminBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return ;
    }
}
