<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class CategoriaController extends AbstractController
{

    /**
     * @Route ("/categoria", name="create_categoria")
     */
    public function createCategoriaAction(Request $request, EntityManagerInterface $em){
        //1. Cogemos la informacion a guardar que nos vienes en la peticion (request)
        $nombreCategoria = $request->get('categoria');
        //2. Creamos un nuevo objeto JsonResponse que va a ser la respuesta que enviaremos de vuelta
        $response = new JsonResponse();
        //3. Tengo que comprobar que la categoria no venga a null o no venga.

        if(!$nombreCategoria){// Solo pasa si es null, o no tiene valor asignado, o si es entero es igual a 0, o es false
            //Nos han enviado mal los datos en la peticion (request)
            $response->setData([
               'success'=> false,
                'data'=> null,
                'error' => 'Categoria controller can´t be null  or empty'
            ]);
            return $response->setStatusCode(404);
        }
        //4. Me ha llega bien el request, tengo que crear un nuevo objeto y setear sus atributos
        $categoria = new Categoria();
        $categoria->setCategoria($nombreCategoria);
        //5. Una vez creado el objeto ya podemos guardarlo en base de datos con EntityManagerInterface

        $em->persist($categoria);// Doctrine -> Prepara la query para guardar el objeto en BD
        $em->flush();// Doctrine -> Ejecuta las querys que tenga pendientes

        //6. Siempre devolver una respuesta
        $response->setData([
           'success'=> true,
           'data'=>[
               'id'=> $categoria->getId(),
               'categoria'=> $categoria->getCategoria(),
           ]
        ]);
        return $response;
    }


    /**
     * @Route("/categoria/list", name="categoria_list")
     */
    public function getAllCategorias(CategoriaRepository $categoriaRepository){
        //1. Llamar al metodo del repository
        $categorias = $categoriaRepository->findAll();
        //2. Comprobar que hay algo
//        if(!$categorias){
//            // Enviar un respuesta de error
//        }
        //Pero ese array de categoria hay que enviarlo en formato Json
        // Que symfony no sabe pasar de array de objetos a Json
        // Hay que coger cada objeto del array y pasarlo a json por separado
        $categoriasAsArray = [];
        foreach ($categorias as $cat){
            $categoriasAsArray[]= [
                'id'=> $cat->getId(),
                'categoria' => $cat->getCategoria()
            ];
        }

        $response = new JsonResponse();
        $response->setData([
           'success'=> true,
           'data' => $categoriasAsArray
        ]);
        return $response;

    }

}