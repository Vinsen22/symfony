<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
class ContactController extends Controller {


    /**
     * @Route("/contact/", name="contact")
     */

    public function indexAction() {
        /*
         * getRepository () : SELECT
         * 4 méthodes de sélection
         * find(id) : récuperer un enregistrement par la PK
         * findAll(): récupérer tous les enregistrements
         * findBy() : recuperer plusieurs enregistrements par une liste de criteres ;
         * (valeur d'une colonne de la table
         */
        $doctrine = $this->getDoctrine();

        $repository = $doctrine->getRepository(Contact::class);
        // Get Repository necessite un parametre, pour interroger une base
        $results = $repository->findAll();

        return $this->render('contact/index.html.twig',[
            'results'=> $results
        ]);


    }


    /**
     *@Route("/contact/form/",name="contact.form", defaults ={"id"=null})
     *@Route("/contact/form/update/{id}",name="contact.update")
     */
    public function formAction(Request $request, $id)
    {
        $doctrine = $this->getDoctrine();
        // instances nécessaires  au formulaire
        // equivaut a : if(id!= null) {} else [$entity = new Contact();
        $entity = $id ? $doctrine->getRepository(Contact::class)->find($id) :  new Contact();
        $type = ContactType::class; // Récupère le chemin

        // création du formulaire
        $form = $this->createForm($type,$entity);

        // récuperation de la saisie
        $form->handleRequest($request);

        // formulaire valide
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            /** insertion de la table
             * 2 branches :
                    getManager () : UPDATE / DELETE / INSERT
             *         persist : permet de faire passer une requete en file d'attente
             *          flush : execution des requetes
                    getRepository () : SELECT; accès a la classe Repository
                    */

            $manager = $doctrine->getManager();
            $manager->persist($data);
            $manager->flush();

            // message de confirmation
            $message = $id ?  "Le contact a bien été modifie " : "Le contact à bien été ajouté ";
            // addFlash permet d'afficher un message temporaire en insérant une valeur de session,valeur de la cle
            $this->addFlash('notice', $message);

            //redirection
            return $this->redirectToRoute('contact'); // prend en parametre le nom de la route

        }
        return $this->render('contact/form.html.twig',[

            'form'=> $form->createView()
        ]);

    }

    /**
     * @Route("/contact/delete/{id}",name="contact.delete", defaults ={"id"=null})
     */
    public function deleteAction(Request $request,$id) {
        /*
         * selection puis une suppression (remove va remplacer persist)
         */
        $doctrine = $this->getDoctrine();
        $contact = $doctrine->getRepository(Contact::class)->find($id);
        $manager = $doctrine->getManager();
        $manager->remove($contact);
        $manager->flush();
        $this->addFlash('notice', "Le contact ~ {$contact->getNom()} {$contact->getPrenom()} ~ a ete supprime ");



        return $this->redirectToRoute('contact');
    }


}



?>