<?php

/* @var $this yii\web\View */
/* @var $model core\models\Promo */
/* @var $isActive boolean */

$this->title = 'Update ' . Yii::t('app', 'Promo') . ' : ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => $isActive ? Yii::t('app', 'Active Promo') : Yii::t('app', 'Inactive Promo'), 'url' => [$isActive ? 'index-active' : 'index-not-active']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id, 'isActive' => $isActive]];
$this->params['breadcrumbs'][] = 'Update'; ?>

<div class="promo-update">

    <?= $this->render('_form', [
        'model' => $model,
        'isActive' => $isActive
    ]) ?>

</div>
