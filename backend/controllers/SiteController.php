<?php

namespace backend\controllers;

use yii\web\Controller;
use yii\web\ErrorAction;

/**
 *
 */
class SiteController extends Controller
{
    public function actions()
    {
        return array_merge(parent::actions(), [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
