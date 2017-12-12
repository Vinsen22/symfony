<?php


namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TwigController extends Controller {

    /**
     *@Route("/layout/",name="layout")
     */
    public function layoutAction()
    {
        return $this->render('twig/layout.html.twig');

    }
	/**
	*@Route("/twig/",name="twig")
	*/
	public function indexAction() {
		/*
		nom du controleur est repris dans le nom du dossier dans app/Ressources/Views
		* nom de l'action (méthode reliée à une route) est repris dans le nom de la vue
		*/
		return $this->render('twig/form.html.twig',[
			'now' => new \DateTime(),
			'list'=> [
				'element1',
				'element2',
				'element3',
			]
		]);
	}






}



?>