<?php

/* @var $this yii\web\View */
/* @var $model core\models\PromoItem */
/* @var $isActive boolean */

$this->title = 'Update ' . Yii::t('app', 'Promo Item') . ' : ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => $isActive ? Yii::t('app', 'Active Promo') : Yii::t('app', 'Inactive Promo'), 'url' => [$isActive ? 'promo/index-active' : 'promo/index-not-active']];
$this->params['breadcrumbs'][] = ['label' => $model->promo->title, 'url' => ['promo/view', 'id' => $model->promo_id, 'isActive' => $isActive]];
$this->params['breadcrumbs'][] = ['label' => 'Item', 'url' => ['index', 'id' => $model->promo_id, 'isActive' => $isActive]];
$this->params['breadcrumbs'][] = ['label' => 'View Item', 'url' => ['view', 'id' => $model->id, 'isActive' => $isActive]];
$this->params['breadcrumbs'][] = 'Update'; ?>

<div class="promo-item-update">

    <?= $this->render('_form', [
        'model' => $model,
        'isActive' => $isActive
    ]) ?>

</div>
