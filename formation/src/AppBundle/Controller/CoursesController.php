<?php
/**
 * Created by PhpStorm.
 * User: Vinsen
 * Date: 11/12/2017
 * Time: 13:38
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Courses;
use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class CoursesController extends Controller
{




    /**
     *@Route("/courses",name="courses")
     */
    public function indexAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(Courses::class);
        // Get Repository necessite un parametre, pour interroger une base
        $results = $repository->findAll();

        return $this->render('courses/index.html.twig',[
            "results"=> $results
        ]);

    }

    /**
     *@Route("/courses/{formation}",name="courses_modules")
     */
    public function modulesAction(Request $request, String $formation)
    {
        $doctrine = $this->getDoctrine();

        $repository = $doctrine->getRepository(Courses::class);
        // Get Repository necessite un parametre, pour interroger une base
        $results = $repository->findBy(array('name'=>$formation));

        return $this->render('courses/formation.html.twig',[
            "results"=> $results
        ]);

    }

    /**
     *@Route("/course/query",name="courses_query")
     */
    public function queryAction()
    {
        $doctrine = $this->getDoctrine();

        // Get Repository necessite un parametre, pour interroger une base
        $repository = $doctrine->getRepository(Courses::class);

        // Appel d'une méthode de la classe de depôt (Repository)
        $results = $repository->testQuery();
        exit(dump($results));


    }

}