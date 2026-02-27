<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField; 

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
{
    return [
        IdField::new('id')->hideOnForm(),
        TextField::new('titre', 'Titre de l\'actualité'),
        
        // Configuration de l'image
        ImageField::new('image')
            ->setBasePath('uploads/articles/') // Chemin pour l'affichage
            ->setUploadDir('public/uploads/articles/') // Chemin pour l'enregistrement
            ->setUploadedFileNamePattern('[randomhash].[extension]') // Évite les noms de fichiers bizarres
            ->setRequired(false),

        TextEditorField::new('contenu', 'Contenu de l\'article'),
    ];
    
}
    
}
