<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\number\NumberControl;
use sycomponent\AjaxRequest;
use sycomponent\NotificationDialog;

/* @var $this yii\web\View */
/* @var $model core\models\Promo */
/* @var $form yii\widgets\ActiveForm */
/* @var $isActive boolean */

kartik\select2\Select2Asset::register($this);
kartik\select2\ThemeKrajeeAsset::register($this);

$ajaxRequest = new AjaxRequest([
    'modelClass' => 'Promo',
]);

$ajaxRequest->form();

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

echo $ajaxRequest->component(); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="x_panel">
            <div class="promo-form">

                <?php
                $form = ActiveForm::begin([
                    'id' => 'promo-form',
                    'action' => $model->isNewRecord ? ['create'] : ['update', 'id' => $model->id, 'isActive' => $isActive],
                    'options' => [

                    ],
                    'fieldConfig' => [
                        'parts' => [
                            '{inputClass}' => 'col-lg-6'
                        ],
                        'template' => '
                            <div class="row">
                                <div class="col-lg-3">
                                    {label}
                                </div>
                                <div class="{inputClass}">
                                    {input}
                                </div>
                                <div class="col-lg-3">
                                    {error}
                                </div>
                            </div>',
                    ]
                ]); ?>

                    <div class="x_content">

                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                    
                        <?= $form->field($model, 'type')->dropDownList(['Voucher-Cashback' => 'Voucher-Cashback', ], ['prompt' => '', 'style' => 'width:100%']) ?>
                    
                        <?= $form->field($model, 'amount', [
                            'parts' => [
                                '{inputClass}' => 'col-lg-4'
                            ],
                        ])->widget(NumberControl::className(), [
                            'maskedInputOptions' => Yii::$app->params['maskedInputOptions']
                        ]) ?>
                    
                        <?= $form->field($model, 'item_amount', [ 
                            'parts' => [
                                '{inputClass}' => 'col-lg-4'
                            ],
                        ])->textInput(['disabled' => !$model->isNewRecord]) ?>
                    
                         <?= $form->field($model, 'date_start', [
                            'parts' => [
                                '{inputClass}' => 'col-lg-4'
                            ],
                        ])->widget(DateTimePicker::className(), [
                            'pluginOptions' => Yii::$app->params['datepickerOptions'],
                        ]) ?>

                        <?= $form->field($model, 'date_end', [
                            'parts' => [
                                '{inputClass}' => 'col-lg-4'
                            ],
                        ])->widget(DateTimePicker::className(), [
                            'pluginOptions' => Yii::$app->params['datepickerOptions'],
                        ]) ?>
                    
                        <?= $form->field($model, 'not_active')->checkbox(['value' => true], false) ?>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-offset-3 col-lg-6">
                                
                                    <?php
                                    $icon = '<i class="fa fa-save"></i> ';
                                    echo Html::submitButton($model->isNewRecord ? $icon . 'Save' : $icon . 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
                                    echo Html::a('<i class="fa fa-times"></i> Cancel', [!empty($isActive) ? ($isActive ? 'index-active' : 'index-not-active') : 'index-active'], ['class' => 'btn btn-default']); ?>
                                
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

<?php
$this->registerCssFile($this->params['assetCommon']->baseUrl . '/plugins/icheck/skins/all.css', ['depends' => 'yii\web\YiiAsset']);

$this->registerJsFile($this->params['assetCommon']->baseUrl . '/plugins/icheck/icheck.min.js', ['depends' => 'yii\web\YiiAsset']);

$jscript = '
    $("#promo-type").select2({
        theme: "krajee",
        placeholder: "' . Yii::t('app', 'Type') . '"
    });
';

$this->registerJs(Yii::$app->params['checkbox-radio-script']() . $jscript); ?>