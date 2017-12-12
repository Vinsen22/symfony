<?php
/**
 * Created by PhpStorm.
 * User: Vinsen
 * Date: 07/11/2017
 * Time: 09:15
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
class MemberController extends  Controller
{
    private $list = [
        ['nom' => 'nom1','prenom'=> 'prenom1', 'photo' => 'yvann.jpg'],
        ['nom' =>'nom2','prenom'=> 'prenom2', 'photo' => 'vinsen.png'],
        ['nom' => 'nom3','prenom'=> 'prenom3', 'photo' => 'kevin.png']
        ];
    /**
     *@Route("/member",name="member")
     */
    public function memberAction(Request $request)
    {

        return $this->render('member/form.html.twig', [

            'list' => $this->list

        ]) ;
    }
    /**
     *@Route("/member/{id}",name="memberId",
     *
     * requirements = {"id"="[0-2]"}
     * )
     */
    public function memberIdAction(Request $request,String $id)
    {
        return $this->render('member/memberId.html.twig', [

            'detail' => $this->list[$id]

        ]) ;
    }


}