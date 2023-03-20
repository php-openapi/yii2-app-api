<?php
namespace common\models\faker;

use Faker\UniqueGenerator;
use common\models\Account;

/**
 * Fake data generator for Account
 * @method static \common\models\Account makeOne($attributes = [], ?UniqueGenerator $uniqueFaker = null);
 * @method static \common\models\Account saveOne($attributes = [], ?UniqueGenerator $uniqueFaker = null);
 * @method static \common\models\Account[] make(int $number, $commonAttributes = [], ?UniqueGenerator $uniqueFaker = null)
 * @method static \common\models\Account[] save(int $number, $commonAttributes = [], ?UniqueGenerator $uniqueFaker = null)
 */
class AccountFaker extends BaseModelFaker
{

    /**
     * @param array|callable $attributes
     * @return \common\models\Account|\yii\db\ActiveRecord
     * @example
     *  $model = (new PostFaker())->generateModels(['author_id' => 1]);
     *  $model = (new PostFaker())->generateModels(function($model, $faker, $uniqueFaker) {
     *            $model->scenario = 'create';
     *            $model->author_id = 1;
     *            return $model;
     *  });
    **/
    public function generateModel($attributes = [])
    {
        $faker = $this->faker;
        $uniqueFaker = $this->uniqueFaker;
        $model = new \common\models\Account();
        //$model->id = $uniqueFaker->numberBetween(0, 1000000);
        $model->name = substr($faker->userName(), 0, 40);
        if (!is_callable($attributes)) {
            $model->setAttributes($attributes, false);
        } else {
            $model = $attributes($model, $faker, $uniqueFaker);
        }
        return $model;
    }
}
