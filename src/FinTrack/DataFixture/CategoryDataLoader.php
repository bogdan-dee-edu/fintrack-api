<?php

namespace FinTrack\DataFixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use FinTrack\Model\OperationTypesStatic;
use FinTrack\Model\User;
use FinTrack\Model\Category;

class CategoryDataLoader implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user1 = $manager->getRepository(User::class)->findOneBy(['username' => 'Богдан']);
        $expenseCats = [
            'Комунальні платежі',
            'Продукти',
            'Проїзд',
            'Інше'
        ];
        foreach ($expenseCats as $cat) {
            $catObj = new Category($user1, $cat, OperationTypesStatic::TYPE_EXPENSE);
            $manager->persist($catObj);
        }
        unset($catObj);

        $incomeCats = [
            'Фріланс',
            'Робота',
            'Інше'
        ];
        foreach ($incomeCats as $cat) {
            $catObj = new Category($user1, $cat, OperationTypesStatic::TYPE_INCOME);
            $manager->persist($catObj);
        }
        unset($catObj);

        $manager->flush();
        $manager->clear();
    }
}