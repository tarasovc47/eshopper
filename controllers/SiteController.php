<?php

namespace app\controllers;

use app\models\Brand;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\base\BaseObject;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $brands = Brand::getAll();
        $query = Product::find()->where(['hidden' => '0']);
        $products_min = Product::find()->min('cost');
        $products_max = Product::find()->max('cost');
        $categories = Category::getAll();
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6]);
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'brands' => $brands,
            'products' => $products,
            'products_cost_min' => $products_min,
            'products_cost_max' => $products_max,
            'categories' => $categories,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCategory($id)
    {
        $brands = Brand::getAll();
        $query = Product::find()->where(['category_id' => $id]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6]);
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $products_min = Product::find()->min('cost');
        $products_max = Product::find()->max('cost');
        $categories = Category::getAll();
        $data['products'] = $products;
        $data['pagination'] = $pagination;
        $category = Category::findOne($id);
        return $this->render('../category/view', [
            'brands' => $brands,
            'products' => $data['products'],
            'pagination' => $data['pagination'],
            'products_cost_min' => $products_min,
            'products_cost_max' => $products_max,
            'categories' => $categories,
            'category' => $category,
        ]);
    }

    public function actionBrand($id)
    {
        $brands = Brand::getAll();
        $query = Product::find()->where(['brand_id' => $id]);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6]);
        $products = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        $products_min = Product::find()->min('cost');
        $products_max = Product::find()->max('cost');
        $categories = Category::getAll();
        $data['products'] = $products;
        $data['pagination'] = $pagination;
        $brand = Brand::findOne($id);
        return $this->render('../brand/view', [
            'brands' => $brands,
            'products' => $data['products'],
            'pagination' => $data['pagination'],
            'products_cost_min' => $products_min,
            'products_cost_max' => $products_max,
            'categories' => $categories,
            'brand' => $brand,
        ]);
    }
}
