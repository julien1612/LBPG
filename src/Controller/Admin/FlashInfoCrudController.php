<?php

namespace App\Controller\Admin;

use App\Entity\FlashInfo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class FlashInfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return FlashInfo::class;
    }

   public function configureFields(string $pageName): iterable
{
    return [
        TextField::new('content', 'Message Flash'), // 'content' doit correspondre à ton entité
        BooleanField::new('isActive', 'Afficher maintenant ?'),
        ImageField::new('image', 'Photo / Logo')
            ->setBasePath('pictures/')
            ->setUploadDir('public/pictures/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
    ];
}   
}   