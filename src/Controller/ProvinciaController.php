<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Provincia;
use App\Form\ProvinciaType;
use Symfony\Component\HttpFoundation\Request;



/**
     * @Route("/provincia")
     */


class ProvinciaController extends Controller
{
    /**
     * @Route("/lista", name="provincia_lista")
     */
    public function listado()
    {

       $repo= $this->getDoctrine()->getRepository(Provincia::class);
        $vectorprovincia = $repo->findAll();
         
         dump($vectorprovincia);


            return $this->render('provincia/index.html.twig', [
            'provincias' => $vectorprovincia,


        ]);
    
    }
   /**
     * @Route("/nuevo", name="provincia_nuevo")
     */
    public function index(Request $request)
    {
        
        $provincia=new Provincia();
        $formu=$this ->createForm(ProvinciaType::class,$provincia);
     
        $formu->handleRequest($request);

        if($formu->isSubmitted()){              
               dump($provincia);
            //em=añadir persona en lista despues de rellenar el formulario. persona/nuevo a persona/lista
            $em = $this->getDoctrine()->getManager();
            $em->persist($provincia);
            $em->flush();
            return $this->redirectToRoute('provincia_lista');

        }

        return $this->render('provincia/nuevo.html.twig', [
            'formulario' => $formu->createview(),
        ]);
    }
 /**
    * @Route("/detalle/{id}", name="provincia_detalle", requirements={"id"="\d+"})
    */
   public function detalle($id)
         
   {
              $repo = $this->getDoctrine()->getRepository(Provincia::class);
              $provincia = $repo->find($id);
              dump($provincia);
               return $this->render('provincia/detalle.html.twig', [           
                'provincia' => $provincia      
              ]);
   }

}



