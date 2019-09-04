<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\AppUser;
use AppBundle\Form\AppUserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/user")
*/
class AppUserController extends Controller
{
    /** 
     * @Route("/")
     * @Method("GET")
    */
    public function indexAction(Request $request) 
    {
        $users = $this->getDoctrine()
                     ->getRepository('AppBundle:AppUser')
                     ->findBy(array(), 
                              array('name' => 'desc'));
                            
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $users,
            $request->get('page', 1),
            5
        );

        $users = $this->get('jms_serializer')->serialize($pagination, 'json');

        return new Response($users);
    }

    /** 
     * @Route("/{id}")
     * @Method("GET")
    */
    public function showAction(AppUser $id)
    {
        if(!$id){
            return new JsonResponse(array('status'=>false,'msg'=>'Usuário não encontrado.'), 404);
        }
        
        $user = $this->get('jms_serializer')->serialize($id, 'json');

        return new Response($user);
    }

    /** 
     * @Route("/save")
     * @Method("POST")
    */
    public function saveAction(Request $request)
    {    
        $data = $request->getContent();
        parse_str($data, $field);

        if(!isset($field['name'])){
            return new JsonResponse(array('status'=> false,'msg'=>'Por favor, o campo NOME é obrigatório'), 404);
        }

        if(!isset($field['cpf'])){
            return new JsonResponse(array('status'=> false,'msg'=>'Por favor, o campo CPF é obrigatório'), 404);
        }

        if(!isset($field['email'])){
            return new JsonResponse(array('status'=> false,'msg'=>'Por favor, o campo E-mail é obrigatório'), 404);
        }

        $user = new AppUser();
        $form = $this->createForm(AppUserType::class, $user);
        $form->submit($field);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new JsonResponse(array('status'=> true,'msg'=>'Usuário cadastrado com sucesso!'), 200);
    }

    /** 
     * @Route("/update")
     * @Method("PUT")
    */
    public function updateAction(Request $request)
    {
        $data = $request->getContent();
        parse_str($data, $field);

        $user = $this->getDoctrine()
                        ->getRepository('AppBundle:AppUser')
                        ->find($field['id']);
     
        if(!$user){
            return new JsonResponse(array('status'=>false,'msg'=>'Usuário não encontrado.'), 404);
        }

        if(!isset($field['name'])){
            return new JsonResponse(array('status'=> false,'msg'=>'Por favor, o campo NOME é obrigatório'), 404);
        }

        if(!isset($field['cpf'])){
            return new JsonResponse(array('status'=> false,'msg'=>'Por favor, o campo CPF é obrigatório'), 404);
        }

        if(!isset($field['email'])){
            return new JsonResponse(array('status'=> false,'msg'=>'Por favor, o campo E-mail é obrigatório'), 404);
        }
            
        $form = $this->createForm(AppUserType::class, $user);
        $form->submit($field);

        $em = $this->getDoctrine()->getManager();
        $em->merge($user);
        $em->flush();

        return new JsonResponse(array('status'=> true,'msg'=>'Usuário alterado com sucesso!'), 200);
    }

    /** 
     * @Route("/{id}")
     * @Method("DELETE")
    */
    public function deleteAction(AppUser $user)
    {      
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        
        return new JsonResponse(array('status'=> true,'msg'=>'Usuário excluído com sucesso!'), 200);
    }
  
}
