<?php

class ConstHelper
{
    /*
     * 基础常量的设置
     * */
    /*
     * 返回获取成功消息和代码
     * */
    const REQUEST_CODE_SUCCESS = 100;
    const REQUEST_MESSAGE_SUCCESS = "获取数据成功";
    /*
     * 返回操作失败的消息和代码
     * */
    const REQUEST_CODE_FAIL = 115;
    const REQUEST_MESSAGE_FAIL = "请求错误";
    /*
     * 返回获取失败没有数据的消息和代码
     * */
    const REQUEST_CODE_FAIL_BECAUSE_NODATA = 101;
    const REQUEST_MESSAGE_FAIL_BECAUSE_NODATA = "没有获取到数据";
    /*
     * 返回获取失败参数错误的消息和代码
     * */
    const REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR = 102;
    const REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR = "参数错误";
    /*
     * 返回文件类型大小不符合要求的信息和code
     */
    const IMAGE_SIZE_ERROR_CODE=103;
    const IMAGE_SIZE_ERROR_MESSAGE="图片超过2MB";

    const IMAGE_MIME_ERROR_CODE=104;
    const IMAGE_MIME_ERROR_MESSAGE="文件类型不符，请上传jpeg/jpg、gif、png格式的图片";
    /*
     * 返回获取失败参数错误详细的消息和代码
     * */
    /*const REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR_ID = 103;
    const REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR_ID = "id错误";

    const REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR_NAME = 104;
    const REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR_NAME = "名字错误";

    const REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR_PHONE = 105;
    const REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR_PHONE = "手机号错误";*/
    /*
     *以下为表单验证的正则规则
     * */
    /*
     *用户名：第一个字母为a-z或大写的6-16位的
     * */
    const MATCH_USERNAME = '/^[a-zA-Z]\w{5,15}$/';
    /*
     *密码：只能6-20个字母、数字、下划线
     * */
    const MATCH_PASSWORD = '/^(\w){6,20}$/';
    /*
     *电话号码
     * */
    const MATCH_PHONE = '/^(\d{3,4}-)\d{7,8}$/';
    /*
     *手机号码
     * */
    const MATCH_MOBILEPHONE = '/^1[3|4|5|7|8][0-9]{9}$/';
    /*
     *身份证：15位或18位数字
     * */
    const MATCH_ID = '/\d{14}[[0-9],0-9xX]/';
    /*
     *邮箱
     * */
    const MATCH_EMAIL = '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/';
}