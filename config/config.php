<?php
return [
    // 首页显示配置
    'dummy_user_id' => 6,
    'dummy_openid' => 'of43pwjQffZPkbMrB-T0ZGEjGZBI-24',
    'toggle_recom' => 1,
    'toggle_theme' => 1,
    'toggle_series' => 1,
    'toggle_allcasa' => 1,
    'photo_folder' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/',
    'image_folder' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/image/',
    'image_tmp_folder' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/tmp/',
    // 探庐者客服电话
    'help_telephone' => '18355146150',
    // 充值卡金额级别
    'coupon_prices' => [
        2000, 3000
    ],
    'coupon_largest_diff' => 300,
    // 备份邮件发送地址
    'system_mail_receivers' => [
        ['name' => 'wenda', 'address' => 'alwayslookback@sina.com'],
        ['name' => 'yunlong', 'address' => 'dragon2590@qq.com'],
    ],
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
        '梅皋坞山居' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/4%E6%A2%85%E7%9A%8B%E5%9D%9E%E5%B1%B1%E5%B1%85.jpg',
        '莫干山居图' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/5%E8%8E%AB%E5%B9%B2%E5%B1%B1%E5%B1%85%E5%9B%BE.jpg',
        '福雅集' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/1%E7%A6%8F%E9%9B%85%E9%9B%86.jpg',
        '小木森森' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/15%E5%B0%8F%E6%9C%A8%E6%A3%AE%E6%A3%AE.jpg',
        '田园曼居' => 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/13%E7%94%B0%E5%9B%AD%E6%9B%BC%E5%B1%85.jpg',
        '枫华'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/18%E6%9E%AB%E5%8D%8E.jpg',
        '树野'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/10%E6%A0%91%E9%87%8E.jpg',
        '谁的花园'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/11%E8%B0%81%E7%9A%84%E8%8A%B1%E5%9B%AD.jpg',
        '天真乐园'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/12%E5%A4%A9%E7%9C%9F%E4%B9%90%E5%9B%AD.jpg',
        '无忧山庄'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/14%E6%97%A0%E5%BF%A7%E5%B1%B1%E5%BA%84.jpg',
        '竹里馆'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/16%E7%AB%B9%E9%87%8C%E9%A6%86.jpg',
        '云起琚'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/17%E4%BA%91%E8%B5%B7%E7%90%9A.jpg',
        '花千谷'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/2%E8%8A%B1%E5%8D%83%E8%B0%B7.jpg',
        '姜湾8号'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/3%E5%A7%9C%E6%B9%BE8%E5%8F%B7.jpg',
        '云镜'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/6%E4%BA%91%E9%95%9C.jpg',
        '沐心坊'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/7%E6%B2%90%E5%BF%83%E5%9D%8A.jpg',
        '栖食號'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/8%E6%A0%96%E9%A3%9F%E8%99%9F.jpg',
        '山瑶铃'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/9%E5%B1%B1%E7%91%B6%E9%93%83.jpg',
        '蓝马书店'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/19%E8%93%9D%E9%A9%AC%E4%B9%A6%E5%BA%97.jpg',
        '斐文·上客堂'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/20%E6%96%90%E6%96%87%E4%B8%8A%E5%AE%A2%E5%A0%82.jpg',
        '号设'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/21%E5%8F%B7%E8%AE%BE.jpg',
        '喜舍'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/22%E5%96%9C%E8%88%8D.jpg',
        '约取·云上'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/23%E4%BA%91%E5%8F%96%E4%BA%91%E4%B8%8A.jpg',
        '一山九舍'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/24%E4%B8%80%E5%B1%B1%E4%B9%9D%E8%88%8D.jpg',
        '大乐之野'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/25%E5%A4%A7%E4%B9%90%E4%B9%8B%E9%87%8E.jpg',
        '画乡院'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/26%E7%94%BB%E4%B9%A1%E9%99%A2.jpg',
        '墨意淌'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/27%E5%A2%A8%E6%84%8F%E6%B7%8C.jpg',
        '森喜'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/28%E6%A3%AE%E5%96%9C.jpg',
        '秘境'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/29%E7%A7%98%E5%A2%83.jpg',
        '莫蕾娜古堡'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/30%E8%8E%AB%E9%9B%B7%E5%A8%9C%E5%8F%A4%E5%A0%A1.jpg',
        '碧山半舍'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/31%E7%A2%A7%E5%B1%B1%E5%8D%8A%E8%88%8D.jpg',
        '水墨居'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/32%E6%B0%B4%E5%A2%A8%E5%B1%85.jpg',
        '田水谣'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/33%E7%94%B0%E6%B0%B4%E8%B0%A3.jpg',
        '听风竹'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/34%E5%90%AC%E9%A3%8E%E7%AB%B9.jpg',
        '云上平田'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/35%E4%BA%91%E4%B8%8A%E5%B9%B3%E7%94%B0.jpg',
        '茶香丽舍'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/36-%E8%8C%B6%E9%A6%99%E4%B8%BD%E8%88%8D.jpg',
        '法兰·萌望'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/37%E6%B3%95%E5%85%B0%E8%90%8C%E6%9C%9B.jpg',
        '遇见指南'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/38-%E9%81%87%E8%A7%81%E6%8C%87%E5%8D%97.jpg',
        '青鸟'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/39-%E9%9D%92%E9%B8%9F.jpg',
        '西田山雨'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/40%E8%A5%BF%E7%94%B0%E5%B1%B1%E9%9B%A8.jpg',
        '朵邑'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/41%E6%9C%B5%E9%82%91.jpg',
        '从前·慢'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/42%E4%BB%8E%E5%89%8D%E6%85%A2.jpg',
        '岚舍'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/43%E5%B2%9A%E8%88%8D.jpg',
        '天香园'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/44%E5%A4%A9%E9%A6%99%E5%9B%AD.jpg',
        '莫干·溪上'=> 'http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/45%E8%8E%AB%E5%B9%B2%E6%BA%AA%E4%B8%8A.jpg',

    ],
    'wx_18_link' => 'http://mp.weixin.qq.com/s?__biz=MzI3MDA4NjAxNQ==&mid=503275835&idx=1&sn=be264acfcd78482256747332bdb85291&scene=0&previewkey=eX4oBJm9UpQ1eozcgHYY6swqSljwj2bfCUaCyDofEow%3D',
];
