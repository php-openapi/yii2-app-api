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
        ]);

        foreach($fakers as $fakerFile) {
            $className = 'common\\models\\' . StringHelper::basename($fakerFile, '.php');
            $this->stdout('Generating fake data for ' . StringHelper::basename($fakerFile, 'Faker.php') . '...');
            for($i = 0; $i < 10; $i++) {
                $faker = new $className;
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
