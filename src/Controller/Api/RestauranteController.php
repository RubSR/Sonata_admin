<?php

namespace App\Controller\Api;

use App\Repository\RestauranteRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\Route("/restaurante")
 */
class RestauranteController extends AbstractFOSRestController
{
    private $repo;

    public function __construct(RestauranteRepository $repo){
        $this->repo = $repo;
    }

    //1. Devolver restaurante por id
    // Me servirá para mostrar la pagina del restaurante con toda su informacion
    /**
     * @Rest\Get (path="/{id}")
     * @Rest\View (serializerGroups={"restaurante"}, serializerEnableMaxDepthChecks=true)
     */
    public function getRestaurante(Request $request){
        //Comprobariamos si existe en el BD
        return $this->repo->find($request->get('id'));
    }
    //2. Devolver listado de restaurantes, segun dia, hora y municipio -> No vais a poder
    // Primero seleccionamos la direccion a la que se va a enviar
    // Luego seleccionamos dia y hora del reparto
    // Mostrar los restaurante que cumplan esas condiciones
    /**
     * @Rest\Post (path="/filtered")
     * @Rest\View (serializerGroups={"res_filtered"}, serializerEnableMaxDepthChecks=true)
     */
    public function getRestaurantesBy(Request $request){
        $dia = $request->get('dia');
        $hora = $request->get('hora');
        $idMunicipio = $request->get('municipio');

        //Comprobar que vienen esos datos, si no viene alguno ->BAD REQUEST
        $restaurantes = $this->repo->findByDayTimeMunicipio($dia,$hora,$idMunicipio);
        return $restaurantes;

    }



}