<?php

namespace backoffice\modules\promo;

use Yii;

/**
 * promo module definition class
 */
class PromoModule extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backoffice\modules\promo\controllers';
    public $defaultRoute = 'promo/index-active';
    public $name = 'Promo';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Yii::configure($this, require __DIR__ . '/config/navigation.php');
    }
}
