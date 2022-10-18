<?php

namespace console\commands;

use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\FileHelper;
use yii\helpers\StringHelper;

/**
 * Populate database with fake data.
 */
class FakerController extends Controller
{
    public function actionIndex()
    {
        $fakers = FileHelper::findFiles(\Yii::getAlias('@common/models'), [
            'only' => ['*Faker.php'],
            'except' => ['BaseModelFaker.php'],
        ]);

        foreach($fakers as $fakerFile) {
            $className = 'common\\models\\faker\\' . StringHelper::basename($fakerFile, '.php');
            $this->stdout('Generating fake data for ' . StringHelper::basename($fakerFile, 'Faker.php') . '...');
            $faker = new $className;
            for($i = 0; $i < 10; $i++) {
                $model = $faker->generateModel();
                if (!$model->save()) {
                    print_r($model->getErrors());
                }
                $this->stdout(".");
            }
            $this->stdout("done.\n", Console::BOLD, Console::FG_GREEN);
        }
    }
}
