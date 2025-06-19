<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Doctrine\ORM\EntityManager;
use FinTrack\Middleware\AddJsonResponseHeader;

use FinTrack\Controller\ApiController;
use FinTrack\Controller\UserController;
use FinTrack\Controller\CategoryController;
use FinTrack\Controller\TransactionController;

use FinTrack\Repository\UserRepository;
use FinTrack\Repository\CategoryRepository;
use FinTrack\Model\User;
use FinTrack\Model\Category;

$container = require_once dirname(__DIR__) . '/bootstrap.php';
$settings = $container->get('settings');

/** Creating and configuring the Slim application */
$app = AppFactory::createFromContainer($container);
$app->addBodyParsingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(
    $settings['slim']['displayErrorDetails'],
    $settings['slim']['logErrors'],
    $settings['slim']['logErrorDetails']
);
$errorHandler = $errorMiddleware->getDefaultErrorHandler(); # TODO: add own error renderer
$errorHandler->forceContentType('application/json'); # TODO: configure logger to write into /logs dir
$app->add(new AddJsonResponseHeader());


// Doctrine repositories
$container->set(UserRepository::class, static function (DI\Container $c) {
    return new UserRepository(
        $c->get(EntityManager::class),
        $c->get(EntityManager::class)->getClassMetadata(User::class)
    );
});

$container->set(CategoryRepository::class, static function (DI\Container $c) {
    return new CategoryRepository(
        $c->get(EntityManager::class),
        $c->get(EntityManager::class)->getClassMetadata(Category::class)
    );
});


// API routes
$app->any('/', [ApiController::class, 'homeAction']);

$app->get('/users/', [UserController::class, 'usersAction']);
$app->get('/users/{id}/', [UserController::class, 'userAction']);

$app->get('/categories/', [CategoryController::class, 'getCategoriesAction']);
$app->post('/categories/', [CategoryController::class, 'postCategoryAction']);
$app->get('/categories/{id}/', [CategoryController::class, 'getCategoryAction']);
$app->put('/categories/{id}/', [CategoryController::class, 'putCategoryAction']);
$app->delete('/categories/{id}/', [CategoryController::class, 'deleteCategoryAction']);

$app->get('/transactions/', [TransactionController::class, 'getTransactionsAction']);
$app->post('/transactions/', [TransactionController::class, 'postTransactionAction']);
$app->get('/transactions/{id}/', [TransactionController::class, 'getTransactionAction']);
$app->put('/transactions/{id}/', [TransactionController::class, 'putTransactionAction']);
$app->delete('/transactions/{id}/', [TransactionController::class, 'deleteTransactionAction']);


$app->run();
