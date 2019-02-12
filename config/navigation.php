<?php
return [
    'params' => [
        'navigation' => [
            'promo' => [
                'label' => 'Promo',
                'iconClass' => 'fa fa-percentage',
                'navigation' => [
                    'pndgApplication' => [
                        'label' => Yii::t('app', 'Active Promo'),
                        'url' => ['promo/promo/index-active'],
                        'isDirect' => false,
                    ],
                    'icorctApplication' => [
                        'label' => Yii::t('app', 'Inactive Promo'),
                        'url' => ['promo/promo/index-not-active'],
                        'isDirect' => false,
                    ],
                ],
            ],
        ]
    ]
];