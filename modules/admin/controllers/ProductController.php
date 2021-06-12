<?php

namespace app\modules\admin\controllers;

use app\models\Brand;
use app\models\Category;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageUpload;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $category = Category::find()->all();


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $category,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSetImage($id)
    {
        $model = new ImageUpload;

        if (Yii::$app->request->isPost)
        {
            $product = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');
            if ($product->saveImage($model->uploadFile($file, $product->image)))
            {
                $this->redirect(['view', 'id' => $product->id]);
            }
        }

        return $this->render('../add_image/image', ['model'=>$model]);
    }

    public function actionSetCategory($id)
    {
        $product = $this->findModel($id);
        $selectedCategory = $product->category->id;
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');

        if (Yii::$app->request->isPost) {
            $category = Yii::$app->request->post('category');
            if ($product->saveCategory($category))
            {
                return $this->redirect(['view', 'id'=>$product->id]);
            }
        }

        return $this->render('category', [
            'product' => $product,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories,
        ]);
    }

    public function actionSetBrand($id)
    {
        $product = $this->findModel($id);
        $selectedBrand = $product->brand->id;
        $brands = ArrayHelper::map(Brand::find()->all(), 'id', 'title');

        if (Yii::$app->request->isPost) {
            $brand = Yii::$app->request->post('brand');
            if ($product->saveBrand($brand))
            {
                return $this->redirect(['view', 'id'=>$product->id]);
            }
        }

        return $this->render('brand', [
            'product' => $product,
            'selectedBrand' => $selectedBrand,
            'brands' => $brands,
        ]);
    }
}
