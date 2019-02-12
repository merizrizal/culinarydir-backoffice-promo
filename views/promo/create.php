<?php

/* @var $this yii\web\View */
/* @var $model core\models\Promo */
/* @var $isActive boolean */

$this->title = Yii::t('app', 'Create Promo');
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="promo-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>