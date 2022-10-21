Generating a Backend with Bootstrap 4
=====================================

Steps:

- Generate some CRUDs for the backend:

      ./yii gii/crud --interactive=0 --modelClass='common\models\User' --searchModelClass='backend\models\UserSearch' --controllerClass='backend\controllers\UserController' --enableI18N --viewPath=@backend/views/user
      ./yii gii/crud --interactive=0 --modelClass='common\models\Task' --searchModelClass='backend\models\TaskSearch' --controllerClass='backend\controllers\TaskController' --enableI18N --viewPath=@backend/views/task
      # ... adjust the above commands based on your models
      
- `composer require yiisoft/yii2-bootstrap4`
- Create `backend/assets/AppAsset.php`:

  ```php
  <?php
  
  namespace backend\assets;
  
  use yii\bootstrap4\BootstrapAsset;
  use yii\web\AssetBundle;
  use yii\web\YiiAsset;
  
  class AppAsset extends AssetBundle
  {
      public $depends = [
          YiiAsset::class,
          BootstrapAsset::class,
      ];
  }
  ```
- require Asset in main layout (`backend/views/layouts/main.php`):

  ```diff
  diff --git a/backend/views/layouts/main.php b/backend/views/layouts/main.php
  index 2180ce6..0f18ba2 100644
  --- a/backend/views/layouts/main.php
  +++ b/backend/views/layouts/main.php
  @@ -5,6 +5,8 @@ use yii\helpers\Html;
   /** @var $this \yii\web\View */
   /** @var $content string */

  +\backend\assets\AppAsset::register($this);
  +
   ?>
   <?php $this->beginPage() ?>
   <!DOCTYPE html>
  ```
  
- Add a navigation to the main layout:

  ```php
    <?php \yii\bootstrap4\NavBar::begin() ?>

        <?= \yii\bootstrap4\Nav::widget([
            'items' => [
                [
                    'label' => 'Tasks',
                    'url' => ['/task/index'],
                ],
                [
                    'label' => 'Users',
                    'url' => ['/user/index'],
                ],
            ]
        ]) ?>

    <?php \yii\bootstrap4\NavBar::end() ?>
  ```


  
