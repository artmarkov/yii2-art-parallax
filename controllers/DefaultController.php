<?php

namespace artsoft\parallax\controllers;
use Yii;

/**
 * CarouselController implements the CRUD actions for artsoft\models\Parallax model.
 */
class DefaultController extends \backend\controllers\DefaultController 
{
   public $modelClass       = 'artsoft\parallax\models\Parallax';
    public $modelSearchClass = 'artsoft\parallax\models\search\ParallaxSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}
