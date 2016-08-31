<?php

namespace app\controllers;

use Yii;
use app\components\Controller;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $model = new \app\models\forms\ChamadoForm;

        if ($model->load($_POST) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Chamado aberto com sucesso!');
            return $this->redirect(['site/index']);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionReport()
    {
        $searchModel = new \app\models\search\ChamadoSearch;
        $dataProvider = $searchModel->search($_GET);
        $dataProvider->pagination->pageSize = 5;

        return $this->render(
            'report',
            ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]
        );
    }
}
