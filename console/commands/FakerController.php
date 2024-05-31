<?php

namespace console\commands;

use Yii;
use yii\base\Model;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use yii\helpers\{FileHelper, VarDumper};
use yii\helpers\StringHelper;

/**
 * Populate database with fake data.
 */
class FakerController extends Controller
{
    /**
     * Fill tables with fake data
     */
    public function actionIndex()
    {
        $fakers = FileHelper::findFiles(\Yii::getAlias('@common/models'), [
            'only' => ['*Faker.php'],
            'except' => ['BaseModelFaker.php'],
        ]);

        $sortedFakersModels = static::sortModels($fakers, '\\common\\models\\faker\\');

        foreach($sortedFakersModels as $justModelClassName) {
            $className = 'common\\models\\faker\\' . StringHelper::basename($justModelClassName, '.php').'Faker';
            $this->stdout('Generating fake data for ' . StringHelper::basename($justModelClassName, 'Faker.php') . '...');
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

    /**
     * Delete all table contents
     */
    public function actionClear($requireConfirm = true): int
    {
        if ($requireConfirm && !$this->confirm('Do you really want to delete all data?')) {
            return ExitCode::OK;
        }

        $fakers = FileHelper::findFiles(\Yii::getAlias('@common/models'), [
            'only' => ['*Faker.php'],
            'except' => ['BaseModelFaker.php'],
        ]);

        $sortedFakersModels = static::sortModels($fakers, '\\common\\models\\faker\\');
        $sortedFakersModels_DESC = array_reverse($sortedFakersModels);
        foreach ($sortedFakersModels_DESC as $modelName) {
            /** @var Model $modelClass */
            $modelClass = 'common\\models\\base\\'.$modelName;
            Yii::$app->db->createCommand()->delete($modelClass::tableName())->execute();
            $this->stdout("Data from $modelName was deleted\n");
        }
        return ExitCode::OK;
    }

    /**
     * Delete all table contents and refill with fake data
     */
    public function actionRefresh(): int
    {
        if (!$this->confirm('Do you really want to delete all data and generate new fake data?')) {
            return ExitCode::OK;
        }

        $this->actionClear(false);
        $this->actionIndex();
        return ExitCode::OK;
    }

    public static function sortModels(array $fakers, string $fakerNamespace = 'app\\models\\')
    {
        $modelsDependencies = [];
        foreach($fakers as $fakerFile) {
            $className = $fakerNamespace . StringHelper::basename($fakerFile, '.php');
            $faker = new $className;

            $modelClassName = str_replace(
                'Faker',
                '',
                StringHelper::basename($fakerFile, '.php')
            );

            if (!method_exists($className, 'dependentOn')) {
                $modelsDependencies[$modelClassName] = null;
            } else {
                $modelsDependencies[$modelClassName] = $className::dependentOn();
            }
        }

        $standalone = array_filter($modelsDependencies, function ($elm) {
            return $elm === null;
        });

        $dependent = array_filter($modelsDependencies, function ($elm) {
            return $elm !== null;
        });

        $justDepenentModels = array_keys($dependent);
        $sortedDependentModels = $justDepenentModels;

        foreach ($justDepenentModels as $model) {
            if ($modelsDependencies[$model] !== null) {
                foreach ($modelsDependencies[$model] as $dependentOn) {
                    if ($modelsDependencies[$dependentOn] !== null) {
                        // move $dependentOn before $model

                        // move model to sort/order
                        // in that function if it is already before (sorted) then avoid it
                        static::moveModel($sortedDependentModels, $dependentOn, $model);
                    }
                }
            }
        }

        $finalSortedModels = array_merge(array_keys($standalone), $sortedDependentModels);
        return $finalSortedModels;
    }

    public static function moveModel(&$sortedDependentModels, $dependentOn, $model)
    {
        $modelKey = array_search($model, $sortedDependentModels);
        $depKey = array_search($dependentOn, $sortedDependentModels);
        if ($depKey < $modelKey) {
            return;
        }

        unset($sortedDependentModels[$depKey]);

        $restRight = array_slice($sortedDependentModels, $modelKey);
        $theKey = (($modelKey) < 0) ? 0 : ($modelKey);
        $restLeft = array_slice($sortedDependentModels, 0, $theKey);

        $sortedDependentModels = array_merge($restLeft, [$dependentOn], $restRight);
    }
}
