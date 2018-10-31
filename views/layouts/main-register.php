<?php
use app\assets\MaterialAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

MaterialAsset::register($this);
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
<body class="create-page"  style="background-color: #9fb0cc">
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