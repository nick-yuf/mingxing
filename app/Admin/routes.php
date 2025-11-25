<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
//    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    //ware
    $router->group(['prefix' => 'ware'], function (Router $route) {
        $route->resource('goods', 'WareGoodsController')->names('ware#goods');
        $route->resource('tools', 'WareToolsController')->names('ware#tools');
        $route->resource('box', 'WareBoxController')->names('ware#box');
        $route->resource('logistics', 'WareLogisticsController')->names('ware#logistics');
        $route->resource('statistics', 'WareStatisticsController')->names('ware#statistics');
    });

    //team
    $router->group(['prefix' => 'team'], function (Router $route) {
        $route->resource('staff', 'TeamStaffController')->names('ware#staff');
        $route->resource('worker', 'TeamWorkerController')->names('ware#worker');
    });

    //info
    $router->group(['prefix' => 'info'], function (Router $route) {
        $route->resource('container', 'InfoContainerController')->names('info#container');
        $route->resource('load', 'InfoLoadController')->names('info#load');
        $route->resource('pack', 'InfoPackController')->names('info#pack');
    });

    //chart
    $router->group(['prefix' => 'chart'], function (Router $route) {
        $route->resource('index', 'ChartController@index')->names('chart#index');
    });
});
