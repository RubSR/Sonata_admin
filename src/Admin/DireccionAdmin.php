<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

final class DireccionAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('calle')
            ->add('numero')
            ->add('puertaPisoEscalera')
            ->add('codPostal')
            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('calle')
            ->add('numero')
            ->add('puertaPisoEscalera')
            ->add('codPostal')
            ->add('cliente')
            ->add('provincia')
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
            //Id autogenerado
            ->add('calle')
            ->add('numero')
            ->add('puertaPisoEscalera')
            ->add('codPostal')
            ->add('cliente', ModelType::class)
            ->add('provincia')
            ->add('municipio')
            ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('calle')
            ->add('numero')
            ->add('puertaPisoEscalera')
            ->add('codPostal')
            ->add('cliente')
            ->add('provincia')
            ->add('municipio')
            ;
    }
}
