<?php

declare(strict_types=1);

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class ClienteAdmin extends AbstractAdmin
{

    //Los filtros
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('nombre')
            ->add('apellidos')
            ->add('telefono')
            ;
    }
        //Las propiedades que parecen en el listado
    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('nombre')
            ->add('apellidos')
            ->add('telefono')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }
    //Los campos en crear y update
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            //El id lo quitamos porque es autogenerado
            ->add('nombre')
            ->add('apellidos')
            ->add('telefono')

            ;
    }
    //Los campos en mostrar
    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('nombre')
            ->add('apellidos')
            ->add('telefono')
            ->add('direcciones')
            ;
    }
}
