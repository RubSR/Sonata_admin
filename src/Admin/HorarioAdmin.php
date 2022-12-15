<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class HorarioAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('restaurante')
            ->add('dia')

            ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('restaurante')
            ->add('dia')
            ->add('apertura')
            ->add('cierre')
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
            //Class en with hace referencia a una clase de boostrap ->css
            ->with('Dia de la semana', ['class' => 'col-md-4'])
                ->add('dia',ChoiceType::class,[
                    'choices'=>[
                        'Lunes'=>1,
                        'Martes'=>2,
                        'Miercoles'=>3,
                        'Jueves'=>4,
                        'Viernes'=>5,
                        'Sabado'=>6,
                        'Domingo'=>7
                    ]
                ])
            ->end()
            ->with('Apertura', ['class' => 'col-md-4'])
                ->add('apertura')
            ->end()
            ->with('Cierre', ['class' => 'col-md-4'])
                ->add('cierre')
            ->end()
            ->add('restaurante')

            ;
    }


    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('dia')
            ->add('apertura')
            ->add('cierre')
            ;
    }
}
