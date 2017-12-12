<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Categories;
use AppBundle\Entity\Livre;
use AppBundle\Form\ContactType;
use AppBundle\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
class CategoriesController extends Controller
{


    /**
     * @Route("/categories/", name="categories")
     */

    public function indexAction()
    {
        /*
         * getRepository () : SELECT
         * 4 méthodes de sélection
         * find(id) : récuperer un enregistrement par la PK
         * findAll(): récupérer tous les enregistrements
         * findBy() : recuperer plusieurs enregistrements par une liste de criteres ;
         * (valeur d'une colonne de la table
         */
        $doctrine = $this->getDoctrine();

        $repository = $doctrine->getRepository(Categories::class);
        // Get Repository necessite un parametre, pour interroger une base
        $results = $repository->findAll();
        return $this->render('categories/index.html.twig', [
            'results' => $results
        ]);




    }

    /**
     * @Route("/categorie/{name}", name="categories_name")
     */
    public function detailsAction(Request $request, String $name)
    {
        $doctrine = $this->getDoctrine();

        $repository = $doctrine->getRepository(Categories::class);
        // Get Repository necessite un parametre, pour interroger une base
        $results = $repository->findBy(array("name"=>$name));

        return $this->render('categories/livre.html.twig', [
            'results' => $results,
            'name'=>$name
        ]);


    }

    /**
     * @Route("/categorieLivre/{id}", name="livre_name")
     */
    public function detailsLivreAction(Request $request, String $id)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository(Livre::class);

        // Get Repository necessite un parametre, pour interroger une base
        $results = $repository->findBy(array("id"=>$id));
        $title = $repository->getTitle($id);

        return $this->render('categories/livre2.html.twig', [
            'results' => $results,
            'title'=>$title,
            'id'=>$id
        ]);


    }


}


?>