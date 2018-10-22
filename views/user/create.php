<?php

use yii\helpers\Html;
use app\models\User;


/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Sign Up';
if (Yii::$app->user->isGuest) {

} else {
	if (User::findIdentity(Yii::$app->user->identity->id)->getRole()===100) {
		$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
		$this->params['breadcrumbs'][] = $this->title;
	}
}
	
?>
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <a href="../site/login"><h2 class="inactive underlineHover"> Sign In </h2></a>
        <a href="../user/create"><h2 class="active">Sign Up </h2></a>
    
            <?= $this->render('_form', [
                
                'model' => $model,
            ]) ?>

</div>
