<?php
return [
    'params' => [
        'navigation' => [
            'promo' => [
                'label' => 'Promo',
                'iconClass' => 'fa fa-percentage',
                'navigation' => [
                    'createPromo' => [
                        'label' => Yii::t('app', 'Create Promo'),
                        'url' => ['promo/promo/create'],
                        'isDirect' => false,
                    ],
                    'activePromo' => [
                        'label' => Yii::t('app', 'Active Promo'),
                        'url' => ['promo/promo/index-active'],
                        'isDirect' => false,
                    ],
                    'notActivePromo' => [
                        'label' => Yii::t('app', 'Inactive Promo'),
                        'url' => ['promo/promo/index-not-active'],
                        'isDirect' => false,
                    ],
                ],
            ],
        ]
    ]
];