<?php

namespace backend\controllers;

use Yii;
use backend\models\Budget;
use backend\models\Transaction;
use backend\models\TransactionSearch;
use backend\models\Type;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransactionSearch();
        $id = Yii::$app->user->identity->id;
        $query = Transaction::find()->joinWith('budget.user')->where(['user_id' => $id]);
        $model = $query;

            $dataProvider = new ActiveDataProvider([
            'query' => $model,
            'pagination' => ['pageSize' => 10],
            ]);
            
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaction();
        $id =Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d H:i:s');
            if ($model->updateBudget($model)) {
               Yii::$app->session->setFlash("success", "La transaction a bien été enregistré");
            }else{
                Yii::$app->session->setFlash("success", "Votre budget est inférieur a la somme requise");
                return $this->goHome();
            };

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'types' => Type::find()->all(),
            'budgets' => Budget::find()->where(['user_id' => $id])->all(), 
        ]);
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $id =Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d H:i:s');
            if ($model->updateBudget($model,true)) {
               Yii::$app->session->setFlash("success", "La transaction a bien été enregistré");
            }else{
                return $this->goHome();
                Yii::$app->session->setFlash("success", "Votre budget est inférieur a la somme requise");
                 return $this->goHome();
            };
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'types' => Type::find()->all(),
            'budgets' => Budget::find()->where(['user_id' => $id])->all(), 
        ]);
    }

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
