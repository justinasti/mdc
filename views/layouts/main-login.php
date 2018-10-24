<?php
use app\assets\MaterialAsset;
use yii\helpers\Html;
use app\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

if (class_exists('app\assets\MaterialAsset')) {
    MaterialAsset::register($this);
}
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-page"  style="background-color: #9fb0cc">
<!-- <img src="https://i1.trekearth.com/photos/43799/te.jpg" style="display:inline; horizontal-align: top; height:500px;"> -->

<?php $this->beginBody() ?>

    <div class="content">
        <?= ramosisw\CImaterial\widgets\Alert::widget() ?>
            <?= $content ?>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>