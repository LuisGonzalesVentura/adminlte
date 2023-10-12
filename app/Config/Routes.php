<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

ini_set('display_errors', '1');
$routes->setAutoRoute(true);
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->get('login', 'Login::index');
$routes->get('crearusuario', 'CrearUsuarios::index');
$routes->get('editarUsuarios/(:num)', 'FormularioDeEditar::editar/$1');
$routes->get('listaeditarusuarios', 'ListaEditarUsuarios::index');
$routes->get('escritorio', 'Dashboard::index');
$routes->get('editarUser/(:num)', 'FormularioDeEditar::editarUsuario/$1');


