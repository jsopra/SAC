<?php

namespace app\components;

use app\components\ActiveRecord;
use app\helpers\StringHelper;
use yii\web\Controller as YiiController;
use yii\web\NotFoundHttpException;
use app\models\forms\FeedbackForm;

class Controller extends YiiController
{
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = [];

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = [];

    /**
	 * Finds the model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return BairroTipo the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
    protected function findModel($id)
    {
        $modelClassName = $this->getModelClassName();
        if (($model = $modelClassName::findOne(intval($id))) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return string
     */
    protected function getModelClassName()
    {
        $className = explode('\\', get_called_class());
        $className = array_pop($className);

        $words = StringHelper::camelToWords($className);

        $words = explode(' ', $words);

        array_pop($words);

        $words = implode(' ', $words);

        return 'app\\models\\' . str_replace(' ', '', ucwords($words));
    }

    /**
     * @param ActiveRecord $model
     * @param array|null $data Dados para atribuir. Por padrão pega o $_POST
     * @return void
     */
    protected function loadAndSaveModel(ActiveRecord $model, $data = null)
    {
        $data = empty($data) ? $_POST : $data;

        if ($model->load($data) && $model->save()) {
            return $this->redirect(['index']);
        }
    }
}
