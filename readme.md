# Casarover_2.0

## 结构
#### PC端
主要是 views/site

``` php
// 约睡活动文件，活动结束无用
views/activity

```

// 度假卡活动删除脚本
// 删除order中的数据
delte from order where type=2
// 删除order_item 中的数据

// 删除casa_order的数据
order_id in ()

// 删除充值卡
delete from coupon
// 删除经销商
delete from dealer
// 删除度假卡机会
delete from opportunity
// 删除机会申请
delete from opportunity_apply
delete from vacation_card_order
// 删除订单和度假卡支付关联
delete from vc_order_relation
