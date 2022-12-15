<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\Direccion;
use App\Repository\DireccionRepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class PedidoAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->remove('create');
        $collection->remove('delete');
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('total')
            ->add('fechaEntrega')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('total')
            ->add('fechaEntrega')
            ->add('cliente')
            ->add('restaurante')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('total')
            ->add('fechaEntrega');
        //Primero->Me guardo el objeto actual que estoy editando
        // Pedido
        $pedido = $this->getSubject();
        //pedido->getCliente()->getId()

        //Comprobamos que estamos en modo editar
        if($this->isCurrentRoute('edit')){
            $form->add('direccion', EntityType::class,[
                'class'=>Direccion::class,
                'query_builder'=> function(DireccionRepository $repo ) use ($pedido){
                 //Devolvemos la query sin ejecutarla
                 return $repo->createQueryBuilder('dir')
                     ->where('dir.cliente = :id')
                     ->setParameter('id', $pedido->getCliente()->getId());
                }
            ]);
        }
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('total')
            ->add('fechaEntrega')
            ->add('cliente')
            ->add('restaurante')
            ;
    }
}
