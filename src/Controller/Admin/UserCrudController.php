<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{

    use Trait\CombinedActionsTrait; 


    public int $genre = 2;

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function __construct()
    {
        $this->setEntityName('App\Entity\Administrateur');
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            // Using ChoiceField for roles
            ChoiceField::new('roles')
                ->setChoices([
                    'administrateur' => 'ROLE_ADMIN',
                    'simple utilisateur' => 'ROLE_USER',
                    // Add other roles as needed
                ])
                ->allowMultipleChoices(),
        ];
    }
    
}
