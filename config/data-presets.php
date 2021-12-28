<?php

return[

    // 角色
    'roles' => [
        ['name' => 'administrator', 'displayName' => '最高權限管理員'],
        ['name' => 'manager' , 'displayName' => '網站管理員'],
        ['name' => 'member' , 'displayName' => '公司成員'],
        ['name' => 'customer' , 'displayName' => '顧客'],
    ],

    'permissions'=>[
        [
            //進入後台
            'name'         => 'admin area',
            'displayName'  => '進入後台',
            'assignTo'     => ['manager','member'],
        ],
        [
            //匯入匯出
            'name'         => 'admin import export',
            'displayName'  => '顧客資料匯入',
            'assignTo'     => ['manager'],
        ],
//        [
//            //行事曆功能
//            'name'         => 'admin calendar',
//            'displayName'  => 'adminCalendar',
//            'assignTo'     => ['manager','member'],
//        ],
        [
            //顧客資料
            'name'         => 'admin user',
            'displayName'  => '顧客資料管理',
            'assignTo'     => ['manager','member'],
        ],
        [
            //權限管理
            'name'         => 'admin permission',
            'displayName'  => '權限管理',
            'assignTo'     => [],
        ],
        [
            //網站設定
            'name'         => 'admin web setting',
            'displayName'  => '網站設定',
            'assignTo'     => ['manager'],
        ],
        [
            //一般設定
            'name'         => 'admin option',
            'displayName'  => '一般設定',
            'assignTo'     => ['manager'],
        ],
        [
            //路由列表
            'name'         => 'admin route list',
            'displayName'  => '路由列表',
            'assignTo'     => [],
        ],
        [
            //網站歷史紀錄
            'name'         => 'admin web log',
            'displayName'  => '網站操作歷史紀錄',
            'assignTo'     => ['manager'],
        ],
        [
            //網站歷史紀錄
            'name'         => 'admin login log',
            'displayName'  => '登入紀錄',
            'assignTo'     => ['manager'],
        ],
        [
            //網站歷史紀錄
            'name'         => 'admin action log',
            'displayName'  => '操作紀錄',
            'assignTo'     => ['manager'],
        ],
        [
            //網站歷史紀錄
            'name'         => 'admin search log',
            'displayName'  => '搜尋紀錄',
            'assignTo'     => ['manager'],
        ],
    ],
    // 預設的設定值
    'options' => [
        'site_name' => config('app.name'),
    ],
    //顧客類型設定值
    'user_type'=>[
        '1'=>'超級名膜隔熱紙',
        '2'=>'磨滴咖啡',
        '3'=>'家傳室內設計',
        '4'=>'白潤美',
        '5'=>'房地產',
    ],
];
