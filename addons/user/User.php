<?php

namespace addons\user;

use app\common\library\Menu;
use think\Addons;

/**
 * 会员扩展插件
 */
class User extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        $menu = [
            [
                'name'    => 'user/scorelog',
                'title'   => '用户积分',
                'icon'    => 'fa fa-file-text-o',
                'sublist' => [
                    ['name' => 'user/scorelog/index', 'title' => 'View'],
                    ['name' => 'user/scorelog/add', 'title' => 'Add'],
                    ['name' => 'user/scorelog/edit', 'title' => 'Edit'],
                    ['name' => 'user/scorelog/del', 'title' => 'Del'],
                    ['name' => 'user/scorelog/multi', 'title' => 'Multi'],
                ]
            ],
            [
                'name'    => 'user/level',
                'title'   => '用户等级',
                'icon'    => 'fa fa-file-text-o',
                'sublist' => [
                    ['name' => 'user/level/index', 'title' => 'View'],
                    ['name' => 'user/level/add', 'title' => 'Add'],
                    ['name' => 'user/level/edit', 'title' => 'Edit'],
                    ['name' => 'user/level/del', 'title' => 'Del'],
                    ['name' => 'user/level/multi', 'title' => 'Multi'],
                ]
            ],
            [
                'name'    => 'user/log',
                'title'   => '用户日志',
                'icon'    => 'fa fa-file-text-o',
                'sublist' => [
                    ['name' => 'user/log/index', 'title' => 'View'],
                    ['name' => 'user/log/del', 'title' => 'Del'],
                    ['name' => 'user/log/multi', 'title' => 'Multi'],
                ]
            ],
        ];
        Menu::create($menu, 'user');
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        return Menu::delete('user/scorelog')
            && Menu::delete('user/log')
            && Menu::delete('user/level');

    }

    /**
     * 插件启用方法
     * @return bool
     */
    public function enable()
    {
        Menu::enable('user/scorelog');
        Menu::enable('user/level');
        Menu::enable('user/log');
        return true;
    }

    /**
     * 插件禁用方法
     * @return bool
     */
    public function disable()
    {
        Menu::disable('user/scorelog');
        Menu::disable('user/level');
        Menu::disable('user/log');
        return true;
    }

}
