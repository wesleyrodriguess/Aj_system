<?php

namespace AjSystem\AdminBundle\Controller;

use AjSystem\AdminBundle\Entity\Administrador;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @Template()
 * @package AjSystem\AdminBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Security("has_role('ROLE_ADMINISTRADOR')")
     */
    public function indexAction(Request $request)
    {
        return ;
    }

    /**
     * @Route("/geraruser/adm")
     */
    public function gerarAction(Request $request)
    {

        $user =  new Administrador();

        $password = $this->get('security.password_encoder')->encodePassword($user, 'admingrazielle');

        $user->setNome("Grazielle");
        $user->setPassword($password);
        $user->setRoles("ROLE_ADMINISTRADOR");
        $user->setEmail("grazielle_aj@gmail.com");
        $user->setActive(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return ;
    }
}
