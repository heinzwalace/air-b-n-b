<?php

namespace App\Controller\Admin\Trait;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

trait CombinedActionsTrait
{
    private $entityName = 'Item';
    private $currentEntity;

    public function setEntityName(string $entityName)
    {
        $this->entityName = $entityName;
    }

    public function setCurrentEntity($entity)
    {
        $this->currentEntity = $entity;
    }

    public function configureActions(Actions $actions): Actions
    {
        $label = '';
        $this->entityName = $this->extractEntityName($this->entityName);

        if ($this->currentEntity) {

            $entityName = $this->currentEntity->getName();
            $firstLetter = strtolower($entityName[0]);
            $label = preg_match('/^[aeiou]$/', $firstLetter)
                ? ($this->genre === 1 ? 'saisir une nouvelle ' . $entityName : 'saisir un nouvel ' . $entityName)
                : ($this->genre === 1 ? 'saisir une nouvelle ' . $entityName : 'saisir un nouveau ' . $entityName);
        } else {
            $firstLetter = strtolower($this->entityName[0]);
            $label = preg_match('/^[aeiou]$/', $firstLetter)
                ? ($this->genre === 1 ? 'saisir une nouvelle ' . $this->entityName : 'saisir un nouvel ' . $this->entityName)
                : ($this->genre === 1 ? 'saisir une nouvelle ' . $this->entityName : 'saisir un nouveau ' . $this->entityName);
        }

        $actions
            ->disable(Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL, Action::EDIT)
            ->update(
                Crud::PAGE_INDEX,
                Action::NEW,
                fn (Action $action) => $action
                    ->setCssClass('btn btn-success')  // Custom CSS class
                    ->setLabel($label)  // Custom label with entity name and genre
            );

        $actions->update(
            Crud::PAGE_NEW,
            Action::SAVE_AND_RETURN,
            fn (Action $action) => $action->setLabel('Valider')->setIcon('fa fa-check')->setCssClass('btn btn-success')
        );

        $actions->remove(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER);

        return $actions;
    }

    public function extractEntityName(string $fqcn): string
    {
        $parts = explode('\\', $fqcn); //dd($fqcn);
        $entityName = end($parts); //dd($entityName);

        return $entityName;
    }
}
