<?php

namespace App\Controller\Api;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Rest\Route("/categoria")
 */
class CatergoriaController extends AbstractFOSRestController
{

    private $categoriaRepository;

    public function __construct(CategoriaRepository $repo)
    {
        $this->categoriaRepository = $repo;
    }

    /**
     * @Rest\Get (path="/")
     * @Rest\View (serializerGroups={"get_categorias"}, serializerEnableMaxDepthChecks = true)
     */

    public function  getCategorias(){
        return $this->categoriaRepository->findAll();
    }


//    public function createCategoria(Request $request){
//        $categoria = $request->get('categoria');
//
//        if(!$categoria){//Comprueba si me llega algun dato pero no el tipo
//            return new JsonResponse('Error en la peticion', Response::HTTP_BAD_REQUEST);
//        }
//        //Crear el objeto y hacer un set del nombre de la categoria que he recibido
//        $cat = new Categoria();
//        $cat->setCategoria($categoria);
//        // Guardamos en base de datos
//        $this->categoriaRepository->add($cat, true);
//        //Enviar una respuesta al cliente
//        return $cat;
//    }
    /**
     * @Rest\Post (path="/")
     * @Rest\View (serializerGroups={"post_categoria"}, serializerEnableMaxDepthChecks= true)
     */
    public function createCategoria(Request $request){
        // Formularios
        // 1. Creo el objeto vacio
        $cat = new Categoria();
        // 2. Inicializamos el form
        $form = $this->createForm(CategoriaType::class, $cat);
        // 3. Le decimos al formulario que maneje la request
        $form->handleRequest($request);
        // 4. Comprobar si hay error
        if(!$form->isSubmitted() || !$form->isValid() ){
            return $form;
        }
        //5. Todo ok, guardo en BD
        $categoria = $form->getData();
        print_r($categoria);
        $this->categoriaRepository->add($categoria, true);
        return $categoria;
    }

}