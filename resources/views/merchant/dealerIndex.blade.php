
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- <script src="/assets/js/integration/jquery.min.js"></script> -->
<link href="/assets/css/back.css" rel="stylesheet"/>
<title>探庐者度假卡经销商后台</title>
<script type="text/javascript">
</script>
</head>


<div id="container">
    <h1 style="text-align:center">探庐者度假卡经销商后台 - {{ $dealer->name or ''}}</h1>
    <br />
    @if(!$wxBind || !$wxBind->dealer_id)
    <div class="col-lg-12 alert alert-warning">
        您还未注册成经销商！
    </div>
    @else
        @if(count($cardList)>0)
        度假卡总数：{{ count($cardList) }} 度假卡总金额：{{ $cardTotal }}
        <table class="table table-hover">
            <tr>
                <th>序号</th>
                <th>
                    下单时间
                </th>
                <th>度假卡号</th>
                <th>用户微信名</th>
                <th>金额</th>
            </tr>
            <?php $number=1;?>
            @foreach ($cardList as $card)
                <tr>
                    <td>{{ $number++ }}</td>
                    <td>
                        {{ $card->created_at }}
                    </td>
                    <td>{{ $card->card_no }}</td>
                    <td>{{ $card->nickname }}</td>
                    <td>{{ $card->total }}</td>
                </tr>
            @endforeach
        </table>
        @endif
        @if(count($couponList)>0)
        抵用券总数：{{ count($couponList) }} 抵用券使用数：{{ $usedCouponCount }}
        <table class="table table-hover">
            <tr>
                <th>序号</th>
                <th>券号</th>
                <th>使用情况</th>
            </tr>
            <?php $number=1;?>
            @foreach ($couponList as $coupon)
                <tr>
                    <td>{{ $number++ }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>
                        @if ($coupon->status == 0)
                        <span style="font-weight:bold">未使用</span>
                        @elseif ($coupon->status == 1)
                        已使用
                        @else
                        未知
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
        @endif
        @if (count($couponList) == 0 && count($cardList) == 0)
        <div class="col-lg-12 alert alert-warning">
            暂无数据！
        </div>
        @endif
    @endif
</div>
</html>
