<?php
namespace app\controllers;

use app\models\Brand;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionView($id) // показ страницы товара
    {
        $id = Yii::$app->request->get('id'); // получаем и записываем в $id полученноге ГЕТом ИД
        $brands = Brand::getAll(); // получаем все бренды
        $product = Product::findOne($id); // получаем все товары
        $products = Product::find()->where(['hidden' => '0'])->all(); //получаем все товары в продаже
        $products_min = Product::find()->min('cost'); // получаем минимальную и максимальную стоимость товара
        $products_max = Product::find()->max('cost');
        $categories = Category::getAll(); // получаем категории
        return $this->render('view', [ // и передаём это всё в вид товара
            'brands' => $brands,
            'items' => $products,
            'products_cost_min' => $products_min,
            'products_cost_max' => $products_max,
            'categories' => $categories,
            'product' => $product,
        ]);
    }
}