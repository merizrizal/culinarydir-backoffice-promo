<?php

/* @var $this yii\web\View */
/* @var $model core\models\Promo */

$this->title = 'Create ' . Yii::t('app', 'Promo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Promo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>