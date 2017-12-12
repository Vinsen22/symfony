<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class DefaultController extends Controller
{
    /* le schéma de la route et le name qui est le nom de la route permettant de faire des liens */
    /**
     * @Route("/", name="homepage")
     */ 
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/form.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /* le schéma de la route et le name qui est le nom de la route permettant de faire des liens */
    /**
     * @Route("/hello/{name}", 
     *   name="hello", 
     *   requirements = {"name"= "[a-zA-Z]+"}, 
     *    defaults= {"name"= "Anonyme"} )   
     * @Method({"GET","POST"})
     */
    public function helloAction(Request $request , String $name)
    {
        // replace this example code with whatever you need
        return $this->render('default/hello.html.twig', [
            
        'key' => 'value',
        'liste'=> ['vinsen','thamboo'],
        'name'=> $name 
    ]);
    }
}
