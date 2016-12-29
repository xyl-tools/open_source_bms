<?php
namespace app\common\controller;

use think\Cache;
use think\Controller;
use think\Db;

class HomeBase extends Controller
{

    protected function _initialize()
    {
        parent::_initialize();
        $this->getSystem();
        $this->getNav();
        $this->getSlide();
    }

    /**
     * 获取站点信息
     */
    protected function getSystem()
    {
        if (Cache::has('site_config')) {
            $site_config = Cache::get('site_config');
        } else {
            $site_config = Db::name('system')->field('value')->where('name', 'site_config')->find();
            $site_config = unserialize($site_config['value']);
            Cache::set('site_config', $site_config);
        }

        $this->assign($site_config);
    }

    /**
     * 获取前端导航列表
     */
    protected function getNav()
    {
        if (Cache::has('nav')) {
            $nav = Cache::get('nav');
        } else {
            $nav = Db::name('nav')->where(['status' => 1])->order(['sort' => 'ASC'])->select();
            $nav = !empty($nav) ? array2tree($nav) : [];
            if (!empty($nav)) {
                Cache::set('nav', $nav);
            }
        }

        $this->assign('nav', $nav);
    }

    /**
     * 获取前端轮播图
     */
    protected function getSlide()
    {
        if (Cache::has('slide')) {
            $slide = Cache::get('slide');
        } else {
            $slide = Db::name('slide')->where(['status' => 1, 'cid' => 1])->order(['sort' => 'DESC'])->select();
            if (!empty($slide)) {
                Cache::set('slide', $slide);
            }
        }

        $this->assign('slide', $slide);
    }
}