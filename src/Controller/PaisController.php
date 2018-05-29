<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Pais;
use App\Form\PaisType;
use Symfony\Component\HttpFoundation\Request;




/**
     * @Route("/pais")
     */
class PaisController extends Controller
{
     /**
     * @Route("/lista", name="pais_lista")
     */
    public function listado()
    {

       $repo= $this->getDoctrine()->getRepository(Pais::class);
        $vectorpais = $repo->findAll();
         
         dump($vectorpais);


            return $this->render('pais/index.html.twig', [
            'paises' => $vectorpais,


        ]);
    
    }
   /**
     * @Route("/nuevo", name="pais_nuevo")
     */
    public function index(Request $request)
    {
        
        $pais=new Pais();
        $formu=$this ->createForm(PaisType::class,$pais);
     
        $formu->handleRequest($request);

        if($formu->isSubmitted()){              
               dump($pais);
            //em=añadir persona en lista despues de rellenar el formulario. persona/nuevo a persona/lista
            $em = $this->getDoctrine()->getManager();
            $em->persist($pais);
            $em->flush();
            return $this->redirectToRoute('pais_lista');

        }

        return $this->render('pais/nuevo.html.twig', [
            'formulario' => $formu->createview(),
        ]);
    }
     /**
    * @Route("/detalle/{id}", name="pais_detalle", requirements={"id"="\d+"})
    */
   public function detalle($id)
         
   {
              $repo = $this->getDoctrine()->getRepository(Pais::class);
              $pais= $repo->find($id);
              dump($pais);
               return $this->render('pais/detalle.html.twig', [           
                'pais' => $pais       
              ]);
   }
}





