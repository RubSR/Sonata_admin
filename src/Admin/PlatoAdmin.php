<?php

declare(strict_types=1);

namespace App\Admin;


use App\Entity\Alergenos;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class PlatoAdmin extends AbstractAdmin
{

    //Filtros
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('nombre')
            ->add('restaurante')
            ->add('precio')
            ;
    }

    //Listado
    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('nombre')

            ->add('restaurante')
            ->add('alergenos')
            ->add('precio')
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }
    //los campos de Post y update
    protected function configureFormFields(FormMapper $form): void
    {
        $form
             //Sonata establece los types por nosotros
            ->add('nombre', TextType::class)
            ->add('descripcion')
            ->add('imgUrl')
            ->add('precio')
            ->add('restaurante')
            //Cuando ponemos tipo que es una relacion
                // Se EntityType -> Solo deja seleccionar, si queremos poder
                // seleccionar o creearuno nuevo de la relacion
            ->add('alergenos', ModelType::class,[
                'class'=>Alergenos::class,
                'multiple'=>true
            ]);
    }
    //Ver uno
    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('nombre')
            ->add('descripcion')
            ->add('imgUrl')
            ->add('precio')
            ;
    }
}
