<?php

namespace App\Controller\Admin;

use App\Entity\Locataire;
use App\Entity\Reservation;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\RequestStack;

class ReservationCrudController extends AbstractCrudController
{
    use Trait\CombinedActionsTrait;

    public int $genre = 1;
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->genre = 1; // ou 2 selon votre préférence
        $this->setEntityName($this->extractEntityName(self::getEntityFqcn()));
        $this->requestStack = $requestStack;
    }


    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     // Mettre à jour l'action existante 'edit' sur la page 'index'
    //     $editAction = Action::new('edit')
    //         ->linkToCrudAction('new');
    
    //     return $actions
    //         ->update(Crud::PAGE_INDEX, Action::EDIT, fn (Action $action) => $editAction);
    // }
    


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Réservation')
            ->setEntityLabelInPlural('Réservations')
            ->setPageTitle('new', 'nouvelle réservation')
            ->setSearchFields(['id', 'debut', 'fin'])
            ->setDefaultSort(['id' => 'DESC']); // Tri par défaut sur createdAt en ordre décroissant

    }

    public function getGenre(): int
    {
        return $this->genre;
    }

    public function setGenre(int $genre): void
    {
        $this->genre = $genre;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Champs non mappés pour Locataire
            IdField::new('id')->hideOnForm(),
            TextField::new('lastname')->setFormTypeOption('mapped', false)->setLabel('Nom')->hideOnIndex(),
            TextField::new('firstname')->setFormTypeOption('mapped', false)->setLabel('prénom')->hideOnIndex(),
            AssociationField::new('locataire', 'Locataire')->formatValue(function ($value, $entity) {
                if ($value instanceof Locataire) {
                    return $value->getFirstname() . ' ' . $value->getLastname();
                }
                return '';
            })->onlyOnIndex(),
            TelephoneField::new('telephone')->setFormTypeOption('mapped', false)->hideOnIndex(),
            EmailField::new('email')->setFormTypeOption('mapped', false)->hideOnIndex(),
            DateField::new('debut')->setRequired(false)->setLabel('arrivée'),
            DateField::new('fin')->setRequired(false)->setLabel('départ'),
            DateField::new('createdAt')->setLabel('créée le ')->hideOnForm(),
            IntegerField::new('nb_jours')->hideOnForm()->setFormTypeOption('empty_data', 10) // Ajout d'une valeur par défaut
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
          // Vérifie si l'instance est de type Reservation
          if ($entityInstance instanceof Reservation) {

            $request = $this->requestStack->getCurrentRequest();
                        $formData = $request->request->all();

            // dd($formData['Reservation']);

            $reservationData = $formData['Reservation'];

                $lastname = $reservationData['lastname'] ?? null;
                $firstname = $reservationData['firstname'] ?? null;
                $telephone = $reservationData['telephone'] ?? null;
                $email = $reservationData['email'] ?? null;

                // Create a new Locataire entity if all required data is present
                if ($lastname && $firstname && $email && $telephone) {
                    $locataire = new Locataire();
                    $locataire->setLastname($lastname);
                    $locataire->setFirstname($firstname);
                    $locataire->setEmail($email);
                    $locataire->setPhone($telephone);

                    // Persist the Locataire entity
                    $entityManager->persist($locataire);
                    $entityManager->flush();

                // Associer le Locataire avec la Réservation
                    $entityInstance->setLocataire($locataire);

                // Persiste les entités
            }

            // Persiste l'entité Reservation
            $entityManager->persist($entityInstance);
            $entityManager->flush();
        }
    
    }
}