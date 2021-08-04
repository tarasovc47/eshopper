<?php

namespace app\controllers;

use app\models\Brand;
use app\models\Category;
use app\models\Product;
use app\models\ViewedProduct;
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

    public function prepareSidebar()
    {
        $brands = Brand::getAll(); //получаем список брендов
        $products_min = Product::find()->min('cost'); //получаем минимальную и максимальную стоимость
        $products_max = Product::find()->max('cost');
        $categories = Category::getAll(); // получаем список категорий
        return [ // передаём в массив
            'brands' => $brands,
            'categories' => $categories,
            'products_cost_min' => $products_min,
            'products_cost_max' => $products_max,
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $wishList = new ViewedProduct();
        $wishList->checkWish(Yii::$app->user->identity->id);
        $query = Product::find()->where(['hidden' => '0']); // получаем список товаров в наличии
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6]); // делаем пагинацию, с количеством товаров на странице = 6
        $products = $query->offset($pagination->offset) // делаем список товаров с учётом пагинации
            ->limit($pagination->limit)
            ->all();
        $array = $this->prepareSidebar(); // получаем массив для отрисовки боковых панелек
        return $this->render('index', [ // и передаём всё в главную страницу
            'products' => $products,
            'pagination' => $pagination,
            'brands' => $array['brands'],
            'categories' => $array['categories'],
            'products_cost_min' => $array['products_cost_min'],
            'products_cost_max' => $array['products_cost_max'],
            'wishList' => $wishList,
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
        $query = Product::find()->where(['category_id' => $id]); // получаем список всех товаров в наличии в данной категории
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6]); // задаём пагинацию
        $products = $query->offset($pagination->offset) // составляем список товаров с учётом пагинации
            ->limit($pagination->limit)
            ->all();
        $array = $this->prepareSidebar(); // получаем массив для отрисовки боковых панелек
        $category = Category::findOne($id); // получаем категорию из $id
        return $this->render('../category/view', [ // и передаём всё в вид категории
            'category' => $category,
            'products' => $products,
            'pagination' => $pagination,
            'brands' => $array['brands'],
            'categories' => $array['categories'],
            'products_cost_min' => $array['products_cost_min'],
            'products_cost_max' => $array['products_cost_max'],
        ]);
    }

    public function actionBrand($id)
    {
        $brand = Brand::findOne($id); // ищем бренд по ИД
        $query = Product::find()->where(['brand_id' => $id]); // получаем список всех товаров в наличии в данной категории
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 6]); // задаём пагинацию
        $products = $query->offset($pagination->offset) // составляем список товаров с учётом пагинации
            ->limit($pagination->limit)
            ->all();
        $array = $this->prepareSidebar(); // получаем массив для отрисовки боковых панелек
        return $this->render('../brand/view', [ // и передаём всё в вид бренда
            'products' => $products,
            'brand' => $brand,
            'pagination' => $pagination,
            'brands' => $array['brands'],
            'categories' => $array['categories'],
            'products_cost_min' => $array['products_cost_min'],
            'products_cost_max' => $array['products_cost_max'],
        ]);
    }
}
