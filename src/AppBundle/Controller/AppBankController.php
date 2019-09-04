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
        $em = $this->getDoctrine()
                    ->getRepository('AppBundle:AppBank')
                    ->createQueryBuilder('b');

        $query = $em->select('b.name')
                    ->getQuery()
                    ->getResult();
        
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
    public function showAction(AppBank $id)
    {
        if(!$id){
            return new JsonResponse(array('status'=>false,'msg'=>'Usuário não encontrado.'), 404);
        }
        
        $bank = $this->get('jms_serializer')->serialize($id, 'json');

        return new Response($bank);
    }
}
