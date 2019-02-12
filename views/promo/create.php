<?php

/* @var $this yii\web\View */
/* @var $model core\models\Promo */
/* @var $isActive boolean */

$this->title = 'Create ' . Yii::t('app', 'Promo');
$this->params['breadcrumbs'][] = ['label' => $isActive ? Yii::t('app', 'Active Promo') : Yii::t('app', 'Inactive Promo'), 'url' => [$isActive ? 'index-active' : 'index-not-active']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="promo-create">

    <?= $this->render('_form', [
        'model' => $model,
        'isActive' => $isActive
    ]) ?>

</div>