<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Enum\StatusEnum;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->getCover() === null) {
            $originalData = $entityManager->getUnitOfWork()->getOriginalEntityData($entityInstance);
            if (!empty($originalData['cover'])) {
                $entityInstance->setCover($originalData['cover']);
            }
        }
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function configureFields(string $pageName): iterable
    {
       return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),

           TextField::new('slug')
               ->onlyOnForms(),

            TextEditorField::new('summary')
                ->onlyOnForms(),

            TextEditorField::new('content')
                ->onlyOnForms(),

           ImageField::new('cover', 'Cover Image')
               ->setUploadDir('public/uploads/images/news')
               ->setBasePath('uploads/images/news')
               ->setUploadedFileNamePattern('[randomhash].[extension]')
               ->setRequired(false)
               ->onlyOnForms(),

            ChoiceField::new('status', 'Status')
                ->setFormType(EnumType::class)
                ->setFormTypeOptions(['class' => StatusEnum::class,])
                ->setChoices(StatusEnum::cases()),

           AssociationField::new('tag', 'Tags')
               ->setFormTypeOptions([
                   'choice_label' => 'title',
                   'multiple' => true
               ])
               ->formatValue(fn($value) => $value ? implode('<br>', array_map(fn($tag) => $tag->getTitle(), $value->toArray())) : ''),

           AssociationField::new('game', 'Games')
               ->setFormTypeOptions([
                   'choice_label' => 'title',
                   'multiple' => true,
                   'by_reference' => false
               ])
               ->formatValue(fn($value) => $value ? implode('<br>', array_map(fn($game) => $game->getTitle(), $value->toArray())) : ''),

           AssociationField::new('author')
                ->setFormTypeOptions(['choice_label' => 'nickname']),
        ];
    }
}
