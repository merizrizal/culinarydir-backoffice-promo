<?php

/* @var $this yii\web\View */
/* @var $model core\models\Promo */

$this->title = 'Update ' . Yii::t('app', 'Promo') . ' : ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Promo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promo-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
