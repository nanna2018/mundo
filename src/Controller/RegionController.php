<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Region;
use App\Form\RegionType;
use Symfony\Component\HttpFoundation\Request;


/**
     * @Route("/region")
     */
class RegionController extends Controller
{
   /**
     * @Route("/lista", name="region_lista")
     */
    public function listado()
    {

       $repo= $this->getDoctrine()->getRepository(Region::class);
        $vectoregion= $repo->findAll();

        
             dump($vectoregion);
            return $this->render('region/index.html.twig', [
            'regiones' => $vectoregion,

        ]);
    }
/**
     * @Route("/nuevo", name="region_nuevo")
     */
    public function index(Request $request)
    {
        
        $region=new Region();
        $formu=$this ->createForm(RegionType::class,$region);
     
        $formu->handleRequest($request);

        if($formu->isSubmitted()){              
               dump($region);
            $em = $this->getDoctrine()->getManager();
            $em->persist($region);
            $em->flush();
            return $this->redirectToRoute('region_lista');

        }

        return $this->render('region/nuevo.html.twig', [
            'formulario' => $formu->createview(),
        ]);
    }
 /**
    * @Route("/detalle/{id}", name="region_detalle", requirements={"id"="\d+"})
    */
   public function detalle($id)
         
   {
              $repo = $this->getDoctrine()->getRepository(Region::class);
              $region = $repo->find($id);
              //dump($region);
               return $this->render('region/detalle.html.twig', [           
                'region' => $region       
              ]);
   }

}
