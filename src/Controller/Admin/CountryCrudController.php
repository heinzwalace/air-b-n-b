<?php

namespace App\Controller\Admin;

use App\Entity\Country;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CountryCrudController extends AbstractCrudController
{

    use Trait\CombinedActionsTrait; 

    public int $genre = 2;


    public static function getEntityFqcn(): string
    {
        return Country::class;
    }

    public function __construct()
    {
        $this->setEntityName('App\Entity\Pays');
    }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
