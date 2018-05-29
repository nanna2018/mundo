<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Localidad;
use App\Form\LocalidadType;
use Symfony\Component\HttpFoundation\Request;




/**
     * @Route("/localidad")
     */

class LocalidadController extends Controller
{
   /**
     * @Route("/lista", name="localidad_lista")
     */
    public function listado()
    {

       $repo= $this->getDoctrine()->getRepository(Localidad::class);
        $vectorlocalidad = $repo->findAll();

        
             dump($vectorlocalidad);
            return $this->render('localidad/index.html.twig', [
            'localidades' => $vectorlocalidad,

        ]);
    }
/**
     * @Route("/nuevo", name="localidad_nuevo")
     */
    public function index(Request $request)
    {
        
        $localidad=new Localidad();
        $formu=$this ->createForm(LocalidadType::class,$localidad);
     
        $formu->handleRequest($request);

        if($formu->isSubmitted()){              
               dump($localidad);
            $em = $this->getDoctrine()->getManager();
            $em->persist($localidad);
            $em->flush();
            return $this->redirectToRoute('localidad_lista');

        }

        return $this->render('localidad/nuevo.html.twig', [
            'formulario' => $formu->createview(),
        ]);
    }
/**
    * @Route("/detalle/{id}", name="localidad_detalle", requirements={"id"="\d+"})
    */
   public function detalle($id)
         
   {
              $repo = $this->getDoctrine()->getRepository(Localidad::class);
              $localidad= $repo->find($id);
              dump($localidad);
               return $this->render('localidad/detalle.html.twig', [           
                'localidad' => $localidad       
              ]);
   }

}
