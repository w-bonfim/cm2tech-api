<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\AppUser;
use AppBundle\Entity\AppBank;
use AppBundle\Entity\AppBankAccount;
use AppBundle\Form\AppBankAccountType;
use AppBundle\Form\AppBankType;

/**
 * @Route("/user")
 */
class AppBankAccountController extends Controller
{
    /** 
     * @Route("/{id}/bank_account")
     * @Method("GET")
    */
    public function indexAction($id) 
    {
        $em   = $this->getDoctrine();
        $user = $em->getRepository('AppBundle:AppUser')->find($id);
        
        if(!$user){
            return new JsonResponse(array('status'=>false,'msg'=>'Usuário não encontrado.'), 404);
        }
                   
        $query = $em->getRepository('AppBundle:AppBankAccount')->findBy(['app_user_id' => $id]);

        $user_banks = $this->get('jms_serializer')->serialize($query, 'json');

        return new Response($user_banks);
    }

    /** 
     * @Route("/{user_id}/bank_account/{bank_id}")
     * @Method("GET")
    */
    public function showBankAction($user_id, $bank_id) 
    {  
        $em   = $this->getDoctrine();
        $user = $em->getRepository('AppBundle:AppUser')->find($user_id);
        $bank = $em->getRepository('AppBundle:AppBank')->find($bank_id);
        
        if(!$user){
            return new JsonResponse(array('status'=>false,'msg'=>'Usuário não encontrado.'), 404);
        }

        if(!$bank){
            return new JsonResponse(array('status'=>false,'msg'=>'Banco não encontrado.'), 404);
        }

        $query = $em->getRepository('AppBundle:AppBankAccount')
                        ->findOneBy([
                            'app_user_id' => $user_id,
                            'app_bank_id' => $bank_id
                        ]);
                   
        $back_user = $this->get('jms_serializer')->serialize($query, 'json');
        
        return new JsonResponse($back_user);
    }

    /** 
     * @Route("/{user_id}/bank_account")
     * @Method("POST")
    */
    public function saveBankAction(Request $request, $user_id) 
    {
        $em   = $this->getDoctrine();
        $user = $em->getRepository('AppBundle:AppUser')->find($user_id);
        
        if(!$user){
            return new JsonResponse(array('status'=>false,'msg'=>'Usuário não encontrado.'), 404);
        }

        $data = $request->getContent();
        parse_str($data, $field);

        if(!isset($field['app_user_id'])){
            $field['app_user_id'] = $user_id;
        }

        if(!isset($field['app_bank_id'])){
            return new JsonResponse(array('status'=>false,'msg'=>'Por favor, selecione uma conta bancária.'), 404);
        }

        $bank = $em->getRepository('AppBundle:AppBank')->find($field['app_bank_id']);

        if(!$bank){
            return new JsonResponse(array('status'=>false,'msg'=>'Banco não encontrado.'), 404);
        }

        $user_bank = new AppBankAccount();
        $form = $this->createForm(AppBankAccountType::class, $user_bank);
        $form->submit($field);
  
        $em = $this->getDoctrine()->getManager();
        $em->persist($user_bank);
        $em->flush();

       return new JsonResponse(array('status'=> true,'msg'=>'Conta bancária cadastrada com sucesso!'), 200);
    }

    /** 
     * @Route("/{user_id}/bank_account/{bank_id}")
     * @Method("POST")
    */
    public function updateBankAction(Request $request, $user_id, $bank_id)
    {
        $data = $request->getContent();
        parse_str($data, $field);
        
        $em   = $this->getDoctrine();
        $user = $em->getRepository('AppBundle:AppUser')->find($user_id);
        $bank = $em->getRepository('AppBundle:AppBank')->find($bank_id);
        
        if(!$user){
            return new JsonResponse(array('status'=>false,'msg'=>'Usuário não encontrado.'), 404);
        }

        if(!$bank){
            return new JsonResponse(array('status'=>false,'msg'=>'Banco não encontrado.'), 404);
        }

        $bank_user = $em->getRepository('AppBundle:AppBankAccount')
                        ->findOneBy([
                            'app_user_id' => $user_id,
                            'app_bank_id' => $bank_id
                        ]);

        if(count($bank_user) < 1){
            return new JsonResponse(array('status'=>false,'msg'=>'Conta bancária não encontrada.'), 404);
        }
        
        if(!isset($field['app_user_id'])){
            $field['app_user_id'] = $user_id;
        }

        if(!isset($field['app_bank_id'])){
            $field['app_bank_id'] = $bank_id;
        }
                 
        $form = $this->createForm(AppBankAccountType::class, $bank_user);
        $form->submit($field);

        $em = $this->getDoctrine()->getManager();
        $em->merge($bank_user);
        $em->flush();

        return new JsonResponse(array('status'=> true,'msg'=>'Conta bancária alterada com sucesso!'), 200);
    }

    /** 
     * @Route("/{user_id}/bank_account/{bank_id}")
     * @Method("DELETE")
    */
    public function deleteAction($user_id, $bank_id)
    {    
        $em   = $this->getDoctrine();
        $user = $em->getRepository('AppBundle:AppUser')->find($user_id);
        $bank = $em->getRepository('AppBundle:AppBank')->find($bank_id);
        
        if(!$user){
            return new JsonResponse(array('status'=>false,'msg'=>'Usuário não encontrado.'), 404);
        }

        if(!$bank){
            return new JsonResponse(array('status'=>false,'msg'=>'Banco não encontrado.'), 404);
        }

        $bank_user = $em->getRepository('AppBundle:AppBankAccount')->findOneBy([
                                                                        'app_user_id' => $user_id,
                                                                        'app_bank_id' => $bank_id
                                                                    ]);

        if(count($bank_user) < 1){
            return new JsonResponse(array('status'=>false,'msg'=>'Conta bancária não encontrada.'), 404);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($bank_user);
        $em->flush();
        
        return new JsonResponse(array('status'=> true,'msg'=>'Conta bancária excluída com sucesso!'), 200);
    }

}
