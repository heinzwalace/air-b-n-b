<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReservationCrudController extends AbstractCrudController
{
    use Trait\CombinedActionsTrait;

    public int $genre = 1;

    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function __construct()
    {
        $this->genre = 1; // ou 2 selon votre préférence
        $this->setEntityName($this->extractEntityName(self::getEntityFqcn()));
    }

    public function getGenre(): int
    {
        return $this->genre;
    }

    public function setGenre(int $genre): void
    {
        $this->genre = $genre;
    }
}
