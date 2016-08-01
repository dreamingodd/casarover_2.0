select * from dealer left join
(select requested.dealer_id, requested.requested_count, used.used_count from
    (select dealer_id, count(*) requested_count, sum(price) requested_total from coupon where status in (0,1) group by dealer_id) requested
    left join
    (select dealer_id, count(*) used_count, , sum(price) used_total from coupon where status = 1 group by dealer_id) used
    on requested.dealer_id = used.dealer_id
) stat on dealer.id = stat.dealer_id
where dealer.coupon_mode = 1
;

select * from dealer left join
(select dvr.dealer_id, count(*) count, sum(total) total from dealer_vacation_relation dvr, dealer, `order`
  where dvr.dealer_id = dealer.id and dvr.vacation_card_order_id = order.id and status = 1
) stat on dealer.id = stat.dealer_id where dealer.deal_mode = 1;
