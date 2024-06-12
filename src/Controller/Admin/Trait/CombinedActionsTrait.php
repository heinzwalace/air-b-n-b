<?php

namespace App\Controller\Admin\Trait;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

trait CombinedActionsTrait
{
    private $entityName = 'Item';

    public function setEntityName(string $entityName)
    {
        $this->entityName = $entityName;
    }

    public function configureActions(Actions $actions): Actions
    {
        // $genreLabel = $this->genre === 1 ? 'Masculin' : 'Féminin';
        $label = '';
        $this->entityName = $this->extractEntityName($this->entityName);
        dump($this->entityName);
        $firstLetter = strtolower($this->entityName[0]);
        //si le nom de l'entité commence par une voyelle
        // if(preg_match('/^[aeiou]$/', $firstLetter)){
        // //si le genre est feminin alors recoit "nouvelle" sinon "nouvel"
        //     $label = $this->genre === 1 ? 'saisir une nouvelle '.$this->entityName : 'saisir un nouvel '.$this->entityName;
        // }else{
        // //sinon si l'entité ne commence pas par une voyelle, 
        // $label = $this->genre === 1 ? 'saisir une nouvelle '.$this->entityName : 'saisir un nouveau '.$this->entityName;
        // }

        $label = preg_match('/^[aeiou]$/', $firstLetter)? ($this->genre === 1 ? 'saisir une nouvelle ' . $this->entityName : 'saisir un nouvel ' . $this->entityName)
                    : ($this->genre === 1 ? 'saisir une nouvelle ' . $this->entityName : 'saisir un nouveau ' . $this->entityName);

        
        $actions
            ->disable(Action::DELETE, Action::EDIT)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(
                Crud::PAGE_INDEX,
                Action::NEW,
                fn (Action $action) => $action
                    ->setCssClass('btn btn-success')  // Custom CSS class
                    ->setLabel($label)  // Custom label with entity name and genre
            );

        return $actions;
    }

    public function extractEntityName(string $fqcn): string
    {
        $parts = explode('\\', $fqcn);//dd($fqcn);
        $entityName = end($parts);//dd($entityName);
        // $entityName = ucfirst(strtolower(preg_replace('/([a-z])([A-Z])/', '$1 $2', $className)));
        
        // Génération du genre en fonction de la valeur de $this->genre
        // if ($this->genre === 1) {
        //     // Générer le féminin si genre vaut 1
        //     $entityName .= 'e'; // Ajouter 'e' pour le féminin
        // } else {
        //     // Générer le masculin sinon
        //     // Peut-être ajouter des exceptions ou des règles plus complexes ici si nécessaire
        // }
        
        return $entityName;
    }
}
