<?php

namespace App\Controller\Admin;

use App\Entity\Cart;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CartCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cart::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setFormTypeOption('disabled','disabled'),
            AssociationField::new('user')->setFormTypeOption('disabled','disabled'),
            CollectionField::new('cartProducts')->useEntryCrudForm(CartProductCrudController::class)->setFormTypeOption('disabled','disabled'),
            ChoiceField::new('status')->autocomplete()->setChoices([
                Cart::STATUS_NEW => Cart::STATUS_NEW,
                Cart::STATUS_PAYED => Cart::STATUS_PAYED,
                Cart::STATUS_CLOSED => Cart::STATUS_CLOSED,
            ])->renderAsBadges([
                Cart::STATUS_NEW => 'warning',
                Cart::STATUS_PAYED => 'success',
                Cart::STATUS_CLOSED => 'danger',
            ])
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Crud::PAGE_NEW, Action::NEW)
        ;
    }
}
