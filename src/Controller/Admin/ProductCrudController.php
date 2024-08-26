<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            MoneyField::new('price')->setCurrency('EUR')->setStoredAsCents(false),
            TextEditorField::new('description'),
            AssociationField::new('category')->setRequired(true),
            Field::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('imageName', 'Image')->setBasePath('/uploads/products')->onlyOnIndex(),
        ];
    }
}
