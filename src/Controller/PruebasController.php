<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PruebasController extends AbstractController
{

    private $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }
    // Tenemos que definir como es el endpoint para poder hacer la peticion desde el cliente
    // ENDPOINT
    /**
     * @Route ("/get/usuarios", name="get_users")
     */
    public function getAllUser(Request $request){
        // Llamará a base de datos y se traerá toda la lista de users
        // Devolver un respuesta en formato Json
        // Request - Peticion
        // Response - Hay que devolver una respuesta
        $response = new Response(); // Esto lleva un codigo de estado
        $response->setContent('<div>Hola Mundo</div>');
        // Capturamos los datos que vienen en el Request
        $id = $request->get('id');
        $this->logger->alert('M');
        // Query sql para traer el user con id = $id
        $response = new JsonResponse();
        $response->setData([
            'succes'=> true,
            'data' =>
                [
                'id' => $id,
                'nombre' => 'Pepe',
                'email' => 'pepe@email.com'
               ],


        ]);
        return $response;

    }

}