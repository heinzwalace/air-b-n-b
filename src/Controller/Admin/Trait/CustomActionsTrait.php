<?php

namespace App\Controller\Admin\Trait;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

trait CustomActionsTrait
{
    public function configureActions(Actions $actions): Actions
    {
        $actions
            ->disable(Action::DELETE, Action::EDIT)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW,
                fn (Action $action) => $action
                    ->setCssClass('btn btn-success')  // Ajout de classes CSS personnalisées
                    ->setLabel('Créer un nouvel élément')  // Changement du texte du bouton
            );

        return $actions;
    }
}
