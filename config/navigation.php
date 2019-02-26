<?php
return [
    'params' => [
        'navigation' => [
            'promo' => [
                'label' => 'Promo',
                'iconClass' => 'fa fa-percentage',
                'navigation' => [
                    'createPromo' => [
                        'label' => 'Create Promo',
                        'url' => ['promo/promo/create'],
                        'isDirect' => false,
                    ],
                    'activePromo' => [
                        'label' => 'Active Promo',
                        'url' => ['promo/promo/index-active'],
                        'isDirect' => false,
                    ],
                    'notActivePromo' => [
                        'label' => 'Inactive Promo',
                        'url' => ['promo/promo/index-not-active'],
                        'isDirect' => false,
                    ],
                ],
            ],
        ]
    ]
];