<?php

namespace App\Common;

/**
 * order status
 */
trait OrderStatus
{
    public function getStatusWord($type, $code)
    {
        $allstatus = $this->allstatus();
        return $allstatus[$type][$code];
    }

    /**
     * @return array $allstatus
     */
    private function allstatus()
    {
        $allstatus = [
            [
                '未付款',
                '已付款',
                '申请退款',
                '已退款'
            ],
            [
                '未预约',
                '已预约',
                '预约失败',
                '已消费',
            ],
        ];
        return $allstatus;
    }

    /**
     * 这个应该写成一个全局的帮助函数
     * @param int $code
     * @param string $msg
     * @param string $data
     */
    public function jsondata($code=0, $msg='成功', $data)
    {
        return ['code'=>$code,'msg'=>$msg,'result'=>$data];
    }
}

