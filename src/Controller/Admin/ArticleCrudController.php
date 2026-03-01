<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\ImageType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
  public function configureFields(string $pageName): iterable
{
    yield TextField::new('titre');
    yield TextEditorField::new('contenu');

    yield CollectionField::new('images')
        ->setEntryType(ImageType::class)
        ->setFormTypeOptions([
            'by_reference' => false, 
        ])
        ->allowAdd()   
        ->allowDelete(); 
}
    
}
