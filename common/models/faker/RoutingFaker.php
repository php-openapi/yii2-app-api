<?php
namespace common\models\faker;

use Faker\UniqueGenerator;
use common\models\Routing;

/**
 * Fake data generator for Routing
 * @method static \common\models\Routing makeOne($attributes = [], ?UniqueGenerator $uniqueFaker = null);
 * @method static \common\models\Routing saveOne($attributes = [], ?UniqueGenerator $uniqueFaker = null);
 * @method static \common\models\Routing[] make(int $number, $commonAttributes = [], ?UniqueGenerator $uniqueFaker = null)
 * @method static \common\models\Routing[] save(int $number, $commonAttributes = [], ?UniqueGenerator $uniqueFaker = null)
 */
class RoutingFaker extends BaseModelFaker
{

    /**
     * @param array|callable $attributes
     * @return \common\models\Routing|\yii\db\ActiveRecord
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
        $model = new \common\models\Routing();
        //$model->id = $uniqueFaker->numberBetween(0, 1000000);
        $model->domain_id = $faker->randomElement(\common\models\Domain::find()->select("id")->column());
        $model->path = $faker->randomElement(["/", "/", "/", "/", "/api", "/tools", "/assets/web"]);
        $model->ssl = $faker->boolean;
        $model->redirect_to_ssl = $faker->boolean;
        $model->service = "http://tador.cebe.net/" . $faker->domainName;
        $model->created_at = $faker->dateTimeThisYear('now', 'UTC')->format('Y-m-d H:i:s');
        $model->d123_id = $faker->randomElement(\common\models\D123::find()->select("id")->column());
        $model->a123_id = $faker->randomElement(\common\models\A123::find()->select("id")->column());
        if (!is_callable($attributes)) {
            $model->setAttributes($attributes, false);
        } else {
            $model = $attributes($model, $faker, $uniqueFaker);
        }
        return $model;
    }

    public static function dependentOn()
    {
        return [
            // model class name
            'Domain',
            'D123',
            'A123',

        ];
    }
}
