<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use common\models\Image;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create','update', 'delete', 'upload'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create','update', 'upload'],
                        'allow' => true,
                        'roles' => ['moder'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();

        if (!Yii::$app->user->can('deletePost')) {
            $searchModel->status = 1;
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

//        $user = User::findModel($model->user_id);
//        $model->user_id = $user->username;

        $model->begin = date('Y-m-d H:i:s', $model->begin);
        $model->end = date('Y-m-d H:i:s', $model->end);
        $model->created_at = date('Y-m-d H:i:s', $model->created_at);
        $model->updated_at = date('Y-m-d H:i:s', $model->updated_at);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $image = new Image();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->begin = strtotime( $model->beginTime);
            $model->end = strtotime( $model->endTime);
            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');

            if ($image->imageFile && $image->upload()) {
                $model->image_id = $image->id;
            }

            if ($model->save(false)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'image' => $image,
        ]);

    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->beginTime = date('Y-m-d H:i:s', $model->begin);
        $model->endTime = date('Y-m-d H:i:s', $model->end);

        $image = new Image();

        if ($model->load(Yii::$app->request->post())) {
            $model->begin = strtotime( $model->beginTime);
            $model->end = strtotime( $model->endTime);

            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');

            if ($image->imageFile && $image->upload()) {
                $model->image_id = $image->id;
            }

            if($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'image' => $image,
        ]);
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->setStatus(0);
        $model->save();

//        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpload()
    {
        $model = new Image();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                return ;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionImageDel()
    {
        if( isset($_POST['id']) ){
            $model = $this->findModel($_POST['id']);
            $model->image_id = NULL;
            $model->save(false);
        }
    }
/*
 * //renderajax
 *
    public function actionDeleteOrderImage()
    {
        if (isset($_POST['image_id'])) {
            $orderId = UserImage::getById($_POST['image_id'])->order_id;
            UserImage::deleteImage($_POST['image_id']);
            $orderImagesData = new ArrayDataProvider([
                'allModels' => UserImage::getAllByOrderId($orderId),
            ]);

            if (\Yii::$app->request->isAjax) {
                return $this->renderAjax('_orderImages', ['orderImagesData' => $orderImagesData]);
            }
        }
    }
*/
}
