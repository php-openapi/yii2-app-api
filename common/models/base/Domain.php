<?php

namespace common\models\base;

/**
 * domain
 *
 * @property int $id
 * @property string $name domain or sub-domain name, in DNS syntax, IDN are converted
 * @property int $account_id user account
 * @property string $created_at
 *
 * @property \common\models\Account $account
 * @property array|\common\models\Routing[] $routings
 */
abstract class Domain extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%domains}}';
    }

    public function rules()
    {
        return [
            'trim' => [['name'], 'trim'],
            'required' => [['name', 'account_id'], 'required'],
            'account_id_integer' => [['account_id'], 'integer'],
            'account_id_exist' => [['account_id'], 'exist', 'targetRelation' => 'Account'],
            'name_string' => [['name'], 'string', 'max' => 128],
        ];
    }

    public function getAccount()
    {
        return $this->hasOne(\common\models\Account::class, ['id' => 'account_id']);
    }

    public function getRoutings()
    {
        return $this->hasMany(\common\models\Routing::class, ['domain_id' => 'id']);
    }
}
