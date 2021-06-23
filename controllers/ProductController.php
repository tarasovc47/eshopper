<?php
namespace app\controllers;

use app\models\Brand;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $brands = Brand::getAll();
        $product = Product::findOne($id);
        $products = Product::find()->where(['hidden' => '0'])->all();
        $products_min = Product::find()->min('cost');
        $products_max = Product::find()->max('cost');
        $categories = Category::getAll();
        return $this->render('view', [
            'brands' => $brands,
            'items' => $products,
            'products_cost_min' => $products_min,
            'products_cost_max' => $products_max,
            'categories' => $categories,
            'product' => $product,
        ]);
    }
}