<?php

namespace App\Tests\Functional;

use App\Controller\Admin\UserCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Contracts\Field\FieldInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class AdminUserPasswordFieldSecurityTest extends TestCase
{
    public function testPasswordFieldIsRequiredOnlyWhenCreatingUser(): void
    {
        $passwordFields = $this->visiblePasswordFields(Crud::PAGE_NEW);

        self::assertCount(1, $passwordFields);
        self::assertTrue($passwordFields[0]->getAsDto()->getFormTypeOption('required'));
    }

    public function testPasswordFieldIsOptionalAndNotDuplicatedWhenEditingUser(): void
    {
        $passwordFields = $this->visiblePasswordFields(Crud::PAGE_EDIT);

        self::assertCount(1, $passwordFields);
        self::assertFalse($passwordFields[0]->getAsDto()->getFormTypeOption('required'));
    }

    /**
     * @return list<FieldInterface>
     */
    private function visiblePasswordFields(string $pageName): array
    {
        $controller = new UserCrudController(
            $this->createMock(UserPasswordHasherInterface::class),
            $this->createMock(ValidatorInterface::class)
        );

        return array_values(array_filter(
            iterator_to_array($controller->configureFields($pageName)),
            static fn (FieldInterface $field): bool => $field->getAsDto()->getProperty() === 'password'
                && $field->getAsDto()->isDisplayedOn($pageName)
        ));
    }
}
