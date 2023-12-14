<?php
return [
    [
        'label' =>'Trang chính',
        'route'=>'admin.statis',
        'icon' =>'fa-home',
    ],
    [
        'label' =>'Quản lý Danh Mục',
        'route' =>'admin.category',
        'icon' =>'fa-window-minimize',
        'item' =>[
            [
                'label'=>'Tất cả Danh Mục',
                'route'=>'category.index'
            ],

            [
                'label'=>'Thêm Danh Mục',
                'route'=>'category.create'
            ]
        ]
    ],

    [
        'label' =>'Quản lý Cơ Sở Lưu Trú',
        'route' =>'admin.lotel',
        'icon' =>'fa-h-square',
        'item' =>[
            [
                'label'=>'Tất cả Cơ Sở Lưu Trú',
                'route'=>'lotel.index'
            ],

            [
                'label'=>'Thêm Cơ Sở Lưu Trú',
                'route'=>'lotel.create'
            ]

        ]
            ],

            [
                'label' =>'Quản lý Cẩm Nang',
                'route' =>'admin.handbook',
                'icon' =>'fa-book',
                'item' =>[
                    [
                        'label'=>'Tất cả Cẩm Nang',
                        'route'=>'handbook.index'
                    ],

                    [
                        'label'=>'Thêm Cẩm Nang',
                        'route'=>'handbook.create'
                    ]

                ]
                    ],
                [
                    'label' =>'Quản lý Tin Tức',
                    'route' =>'admin.news',
                    'icon' =>'fa-newspaper',
                    'item' =>[
                        [
                            'label'=>'Tất cả Tin Tức',
                            'route'=>'news.index'
                        ],

                        [
                            'label'=>'Thêm Tin Tức',
                            'route'=>'news.create'
                        ]

                    ]
                        ],
                [
                    'label' =>' Quản lý Điểm Đến Phổ Biến',
                    'route' =>'admin.location',
                    'icon' =>'fa-globe ',
                    'item' =>[
                        [
                            'label'=>'Tất cả Điểm Đến Phổ Biến',
                            'route'=>'location.index'
                        ],

                        [
                            'label'=>'Thêm Điểm Đến Phổ Biến',
                            'route'=>'location.create'
                        ]

                    ]
                        ],
                [
                    'label' =>' Quản lý Người Dùng',
                    'route' =>'admin.users',
                    'icon' =>'fa-user',
                    'item' =>[
                        [
                            'label'=>'Tất cả Người Dùng',
                            'route'=>'users.index'
                        ],

                    ]
                        ],
                [
                    'label' =>'Quản lý Đơn Đặt Phòng',
                    'route' =>'admin.lotel',
                    'icon' =>'fa-handshake',
                    'item' =>[
                        [
                            'label'=>'Đơn Đặt Phòng Mới',
                            'route'=>'order.new'
                        ],
                        [
                            'label'=>'Xác nhận Thanh Toán',
                            'route'=>'order.payment'
                        ],

                        [
                            'label'=>'Tất cả Đơn Đã Xử Lý',
                            'route'=>'order.profile'
                        ],

                    ]
                        ],
                        [
                            'label' =>'Quản lý tiện ích',
                            'route' =>'admin.lotel',
                            'icon' =>'fa-cog',
                            'item' =>[
                                [
                                    'label'=>'Tất cả Tiện Ích',
                                    'route'=>'equipment.index'
                                ],
                                [
                                    'label'=>'Thêm Tiện Ích',
                                    'route'=>'equipment.create'
                                ],



                            ]
                                ],

]
?>
