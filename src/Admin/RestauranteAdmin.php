<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class RestauranteAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('nombre')
            ->add('logo_url')
            ->add('imagenUrl')
            ->add('descripcion')
            ->add('destacado')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('nombre')
            ->add('logo_url')
            ->add('imagenUrl')
            ->add('descripcion')
            ->add('destacado')
            ->add('municipio')
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

            ->add('nombre')
            ->add('logo_url')
            ->add('imagenUrl')
            ->add('descripcion')
            ->add('destacado')
            ->add('municipio')
            ->add('categorias')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('nombre')
            ->add('logo_url')
            ->add('imagenUrl')
            ->add('descripcion')
            ->add('destacado')
            ->add('municipio')
            ->add('categorias')
            ->add('platos')
            ;
    }
}
