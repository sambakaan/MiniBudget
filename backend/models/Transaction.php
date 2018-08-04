<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%transaction}}".
 *
 * @property int $id
 * @property string $description
 * @property int $montant
 * @property string $date
 * @property int $type_id
 * @property int $budget_id
 *
 * @property Budget $budget
 * @property Type $type
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%transaction}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'montant', 'date', 'type_id', 'budget_id'], 'required'],
            [['montant', 'type_id', 'budget_id'], 'integer'],
            [['date'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Budget::className(), 'targetAttribute' => ['budget_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'montant' => 'Montant',
            'date' => 'Date',
            'type_id' => 'Type ID',
            'budget_id' => 'Budget ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget()
    {
        return $this->hasOne(Budget::className(), ['id' => 'budget_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }


    public function updateBudget($model,$isUpdate = false){
        $budget = Budget::find()->where(['id' => $model->budget_id])->one();
        $idType = intval($model->type_id);
        if ($idType === 1) {
            return $this->setDepense($budget,$model,$isUpdate);
        }elseif ($idType === 2) {
            return $this->setRevenu($budget,$model,$isUpdate);
        }
    }

    private function setDepense($budget,$model,$isUpdate)
    {
        if ($isUpdate) {
            $budget->somme += $model->oldAttributes['montant'];
        }

        if($budget->somme < $model->montant){
            return false;
        }


        $budget->somme -= $model->montant;

        if (!$budget->save()) {
            die("Une erreur est survenue lors de l'enregistrement de la dépense");
        };

        return true;
    }

    private function setRevenu($budget,$model,$isUpdate)
    {
        
        if ($isUpdate) {
            $budget->somme -= $model->oldAttributes['montant'];
        }
        $budget->somme += $model->montant;
        if (!$budget->save()) {
            die("Une erreur est survenue lors de l'enregistrement du revenu");
        };
        
        return true;
    }


}
