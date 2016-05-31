<?php
return [
    // 首页显示配置
    'toggle_recom' => 1,
    'toggle_theme' => 1,
    'toggle_series' => 1,
    'toggle_allcasa' => 1,
    'photo_folder' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/',
    'image_folder' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/image/',
    'image_tmp_folder' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/tmp/',
    'help_telephone' => '18355146150',
    // 预定平台可抵最高折扣百分比 - %
    'wx_max_discount' => 30,
    // 预订平台-用户等级
    'wx_membership_detail' => [
        ['level' => '0', 'name' => '普通会员', 'convert_percent' => '20', 'score' => '0'],
        ['level' => '1', 'name' => '黄金会员', 'convert_percent' => '40', 'score' => '2000'],
        ['level' => '2', 'name' => '白金会员', 'convert_percent' => '50', 'score' => '5000'],
        ['level' => '3', 'name' => '终极会员', 'convert_percent' => '50', 'score' => '500000'],
    ],
    // wx 18 pics
    'wx_18_pics' => [
        '梅皋坞山居【感恩粉丝回馈中】' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/4%E6%A2%85%E7%9A%8B%E5%9D%9E%E5%B1%B1%E5%B1%85.jpg',
        '莫干山居图' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/17%E4%BA%91%E8%B5%B7%E7%90%9A.jpg',
    ],
];
