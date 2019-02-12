<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use sycomponent\AjaxRequest;
use sycomponent\ModalDialog;
use sycomponent\NotificationDialog;

/* @var $this yii\web\View */
/* @var $model core\models\Promo */
/* @var $isActive boolean */

$ajaxRequest = new AjaxRequest([
    'modelClass' => 'Promo',
]);

$ajaxRequest->view();

$status = Yii::$app->session->getFlash('status');
$message1 = Yii::$app->session->getFlash('message1');
$message2 = Yii::$app->session->getFlash('message2');

if ($status !== null) {

    $notif = new NotificationDialog([
        'status' => $status,
        'message1' => $message1,
        'message2' => $message2,
    ]);

    $notif->theScript();
    echo $notif->renderDialog();
}

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => $isActive ? Yii::t('app', 'Active Promo') : Yii::t('app', 'Inactive Promo'), 'url' => [$isActive ? 'index-active' : 'index-not-active']];
$this->params['breadcrumbs'][] = $this->title;

echo $ajaxRequest->component(); ?>

<div class="promo-view">

    <div class="row">
        <div class="col-sm-12">
            <div class="x_panel">

                <div class="x_content">

                    <?= Html::a('<i class="fa fa-upload"></i> Create', ['create', 'isActive' => $isActive], ['class' => 'btn btn-success']) ?>

                    <?= Html::a('<i class="fa fa-pencil-alt"></i> Edit', ['update', 'id' => $model->id, 'isActive' => $isActive], ['class' => 'btn btn-primary']) ?>

                    <?= Html::a('<i class="fa fa-trash-alt"></i> Delete', ['delete', 'id' => $model->id, 'isActive' => $isActive], [
                        'id' => 'delete',
                        'class' => 'btn btn-danger',
                        'data-not-ajax' => 1,
                        'model-id' => $model->id,
                        'model-name' => $model->title,
                    ]) ?>

                    <?= Html::a('<i class="fa fa-times"></i> Cancel', [$isActive ? 'index-active' : 'index-not-active'], ['class' => 'btn btn-default']) ?>

                    <div class="clearfix" style="margin-top: 15px"></div>

                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => [
                            'class' => 'table'
                        ],
                        'attributes' => [
                            'title',
                            'type',
                            'amount:currency',
                            'item_amount',
                            'date_start',
                            'date_end',
                            [
                                'attribute' => 'not_active',
                                'format' => 'raw',
                                'value' => Html::checkbox('not_active', $model->not_active, ['value' => $model->not_active, 'disabled' => 'disabled']),
                            ],
                        ],
                    ]) ?>

                </div>

            </div>
        </div>
    </div>

</div>

<?php
$modalDialog = new ModalDialog([
    'clickedComponent' => 'a#delete',
    'modelAttributeId' => 'model-id',
    'modelAttributeName' => 'model-name',
]);

$modalDialog->theScript(false);

echo $modalDialog->renderDialog();

$this->registerCssFile($this->params['assetCommon']->baseUrl . '/plugins/icheck/skins/all.css', ['depends' => 'yii\web\YiiAsset']);

$this->registerJsFile($this->params['assetCommon']->baseUrl . '/plugins/icheck/icheck.min.js', ['depends' => 'yii\web\YiiAsset']);

$jscript = Yii::$app->params['checkbox-radio-script']()
    . '$(".iCheck-helper").parent().removeClass("disabled");
';

$this->registerJs($jscript); ?>