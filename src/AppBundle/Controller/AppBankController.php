<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\AppBank;


/**
 *  @Route("/bank")
*/
class AppBankController extends Controller
{
    /** 
     * @Route("/")
     * @Method("GET")
    */
    public function indexAction(Request $request) 
    { 
        $em   = $this->getDoctrine();
        $query = $em->getRepository('AppBundle:AppBank')->findAll();
        
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $query,
            $request->get('page', 1),
            5
        );

        $banks = $this->get('jms_serializer')->serialize($pagination, 'json');

        return new Response($banks);
    }

    /** 
     * @Route("/{id}")
     * @Method("GET")
    */
    public function showAction($id)
    {
        $em   = $this->getDoctrine();
        $bank = $em->getRepository('AppBundle:AppBank')->find($id);

        if(!$bank){
            return new JsonResponse(array('status'=>false,'msg'=>'Banco não encontrado.'), 404);
        }
        
        $bank = $this->get('jms_serializer')->serialize($bank, 'json');

        return new Response($bank);
    }
}
