<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%budget}}".
 *
 * @property int $id
 * @property int $somme
 * @property int $user_id
 * @property string $date_ajout
 *
 * @property User $user
 * @property Transaction[] $transactions
 */
class Budget extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%budget}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['somme', 'date_ajout'], 'required'],
            [['somme', 'user_id'], 'integer'],
            [['date_ajout'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'N°',
            'somme' => 'Etat Budget',
            'user_id' => 'User ID',
            'date_ajout' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['budget_id' => 'id']);
    }
}
