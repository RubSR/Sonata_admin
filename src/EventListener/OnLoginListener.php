<?php

namespace App\EventListener;

use App\Repository\ClienteRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class OnLoginListener
{

    private $repo;
    public function __construct(ClienteRepository $repository)
    {
        $this->repo = $repository;
    }
    //Metodo que se va quedar a la escucha de que se
    // dispare el evento de on login success response
    // traducion: respuesta del login conseguido
    public function pepe(AuthenticationSuccessEvent $event){
        // Cojo todos los datos de la respuesta
        $data = $event->getData();
        // Me traigo el User
        $user = $event->getUser();
        if(!$user instanceof UserInterface){
            return;
        }
        $data['userId'] = $user->getId();
        $clienteId = null;
        //Traer el cliente -
        $cliente = $this->repo->findOneBy(['user'=>$user]);
        if($cliente){
            $clienteId = $cliente->getId();
        }
        //Por ultimo añadimos los campos a la respuesta
        $data['idCliente'] =$clienteId;
        $event->setData($data);

    }
}