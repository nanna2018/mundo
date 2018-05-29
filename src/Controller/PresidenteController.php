<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Presidente;
use App\Form\PresidenteType;
use Symfony\Component\HttpFoundation\Request;



/**
     * @Route("/presidente")
     */


class PresidenteController extends Controller
{
     /**
     * @Route("/lista", name="presidente_lista")
     */
    public function listado()
    {

       $repo= $this->getDoctrine()->getRepository(Presidente::class);
        $vectorpresidente = $repo->findAll();
         
         dump($vectorpresidente);


            return $this->render('presidente/index.html.twig', [
            'presidentes' => $vectorpresidente,


        ]);
    
    }

   /**
     * @Route("/nuevo", name="presidente_nuevo")
     */
    public function index(Request $request)
    {
        
        $presidente=new Presidente();
        $formu=$this ->createForm(PresidenteType::class,$presidente);
     
        $formu->handleRequest($request);

        if($formu->isSubmitted()){              
               dump($presidente);
            $em = $this->getDoctrine()->getManager();
            $em->persist($presidente);
            $em->flush();
            return $this->redirectToRoute('presidente_lista');

        }

        return $this->render('presidente/nuevo.html.twig', [
            'formulario' => $formu->createview(),
        ]);
    }
    /**
    * @Route("/detalle/{id}", name="presidente_detalle", requirements={"id"="\d+"})
    */
   public function detalle($id)
         
   {
              $repo = $this->getDoctrine()->getRepository(Presidente::class);
              $presidente = $repo->find($id);
              dump($presidente);
               return $this->render('presidente/detalle.html.twig', [           
                'presidente' => $presidente       
              ]);
   }
}




