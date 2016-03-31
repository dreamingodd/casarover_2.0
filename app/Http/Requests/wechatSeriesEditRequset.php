<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class wechatSeriesEditRequset extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;
    }
    public function messages()
    {
        return [
            'name.required' => '名称不能为空！',
            'name.unique' => '该系列以存在！',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|unique:wechat_series'
        ];
    }
}
