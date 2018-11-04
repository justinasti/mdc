<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Groups */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="card-content">

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'description',
                // 'created_at',
                // 'updated_at',
            ],
        ]) ?>

        <br>

        <p>
            <?= Html::a('Add Members', ['/groupmembers/create', 'groupid' => $model->id], ['class' => 'btn btn-success']) ?>
        </p>

        <div class="container">
            <h4>Group Members</h4>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($members as $member) : ?>
                    <tr>
                        <td><?= User::findOne(['id' => $member->userid])->name ?></td>
                        <td><?= $member->grouprole===0 ? 'Leader' : 'Member' ?></td>
                        <td>
                            <?= Html::a('Delete', ['/groupmembers/delete', 'id' => $member->id, 'groupId' => $model->id], 
                                                ['class' => 'btn btn-danger btn-sm',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this item?',
                                                    'method' => 'post',
                                                ],
                                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>
