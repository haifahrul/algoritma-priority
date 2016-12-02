<?php
/**
 * Created by PhpStorm.
 * User: haifa
 * Date: 6/30/2016
 * Time: 18:19
 */
namespace app\components;

use yii\base\BootstrapInterface;

class PathUrl implements BootstrapInterface {
    public function bootstrap($app) {
        // Logo
        $app->params['logo'] = $app->urlManager->baseUrl . '/public/images/site/logo.png';
        // Url
        $app->params['imagesUrl'] = $app->urlManager->baseUrl . '/public/images/';
        $app->params['siteUrl'] = $app->urlManager->baseUrl . '/public/images/site';
        $app->params['avatarUrl'] = $app->urlManager->baseUrl . '/public/images/avatar/';
        $app->params['productUrl'] = $app->urlManager->baseUrl . '/public/images/product/';
        // Path
        $app->params['imagesPath'] = $app->basePath . '/public/images/';
        $app->params['sitePath'] = $app->basePath . '/public/images/site/';
        $app->params['avatarPath'] = $app->basePath . '/public/images/avatar/';
        $app->params['productPath'] = $app->basePath . '/public/images/product/';
    }
}