<?php

namespace App\Controller\Admin;

use App\Entity\CartProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CartProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CartProduct::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('product.name'),
            NumberField::new('quantity'),
        ];
    }
}
