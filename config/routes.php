<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    $routes->applyMiddleware('csrf');

    $routes->setExtensions(['json']);

    $routes->connect('/', ['controller' => 'Home', 'action' => 'index']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/signup', ['controller' => 'Users', 'action' => 'signup']);
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
    $routes->connect('/profile', ['controller' => 'Users', 'action' => 'profile']);
    $routes->connect('/dashboard', ['controller' => 'Users', 'action' => 'dashboard']);
//    $routes->connect('/recipes', ['controller' => 'Recipes', 'action' => 'display']);
    $routes->connect('/articles', ['controller' => 'Articles', 'action' => 'index']);

    $routes->connect('/profile/*', ['controller' => 'Users', 'action' => 'profile']);
    $routes->connect('/my-recipes', ['controller' => 'Users', 'action' => 'manage']);

    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    $routes->fallbacks(DashedRoute::class);
});

Router::scope('/recipes', function (RouteBuilder $routes) {
    $routes->setExtensions(['json']);
    $routes->connect('/', ['controller' => 'Recipes', 'action' => 'index']);
    $routes->get('/post/:slug', ['controller' => 'Recipes', 'action' => 'detail'], 'recipes.detail')->setPass(['slug']);
    $routes->connect('/add', ['controller' => 'Recipes', 'action' => 'add']);
    $routes->connect('/edit/:id', ['controller' => 'Recipes', 'action' => 'edit'])->setPass(['id']);
    $routes->connect('/delete/:id', ['controller' => 'Recipes', 'action' => 'delete'])->setPass(['id']);
    $routes->connect('/image-upload', ['controller' => 'Recipes', 'action' => 'imageUpload']);

    $routes->fallbacks(DashedRoute::class);
});

Router::scope('/tip-tricks', function (RouteBuilder $routes) {
    $routes->setExtensions(['json']);
    $routes->get('', ['controller' => 'TipTricks', 'action' => 'index'], 'tip-tricks.list');
    $routes->get('/:slug', ['controller' => 'TipTricks', 'action' => 'detail'], 'tip-tricks.detail')->setPass(['slug']);
    $routes->fallbacks(DashedRoute::class);
});

Router::prefix('admin', function (RouteBuilder $routes) {
    $routes->setExtensions(['json']);
    $routes->connect('/', ['controller' => 'Admin', 'action' => 'index']);
    $routes->connect('/recipes/edit/:id', ['controller' => 'Recipes', 'action' => 'edit'])->setPass(['id']);
    $routes->connect('/recipes/delete/:id', ['controller' => 'Recipes', 'action' => 'delete'])->setPass(['id']);
    $routes->fallbacks(DashedRoute::class);
});
