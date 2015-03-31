<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        echo "THINKPHP 默认方法 R('Home/Index/index')\n";
    }
}