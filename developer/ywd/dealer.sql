select * from dealer left join
(select requested.dealer_id, requested.requested_count, used.used_count from
    (select dealer_id, count(*) requested_count from coupon where status in (0,1) group by dealer_id) requested
    left join
    (select dealer_id, count(*) used_count from coupon where status = 1 group by dealer_id) used
    on requested.dealer_id = used.dealer_id
) stat on dealer.id = stat.dealer_id
;
