<?php
/**
 * Created by PhpStorm.
 * User: ph
 * Date: 2016/5/22
 * Time: 23:12
 */

namespace ph\input;

/**处理get、post、session的参数传值问题
 * Class Input
 * @package ph\input
 */
class input
{
    public function __construct()
    {
        $this->input_error = null;//待处理
    }

    /**获取系列get型请求参数值
     * @param array $paras    请求参数表
     * @param bool $filter  标签过滤器
     * @return array|null
     */
    public function gets($paras=[],$filter=true){
        $result = array();
        foreach ($paras as $para) {
            if(isset($_GET[$para])){
                $result[$para] = $filter?strip_tags($_GET[$para]):$_GET[$para];
            }else{
                return null;
            }
        }
        return $result;
    }

    /**获取一个get型请求值
     * @param string $para
     * @param string|null  $default 默认为null，如果请求参数值为null则返回该值
     * @param bool $filter  标签过滤器,默认开启
     * @return array|null
     */
    public function get($para,$default=null,$filter=true){
        if(!($value = $this->gets([$para],$filter)[$para])){
            return $default;
        }else{
            return $value;
        }
    }

    /**获取系列post型请求值
     * @param $paras
     * @param bool $filter
     * @return array|null
     */
    public function posts($paras,$filter=true){
        $result = array();
        foreach ($paras as $para) {
            if(isset($_POST[$para])){
                $result[$para] = $filter?strip_tags($_POST[$para]):$_POST[$para];
            }else{
                return null;
            }
        }
        return $result;
    }

    /**获取一个post请求值
     * @param $para
     * @param $default 默认为null，如果请求参数值为null则返回该值
     * @param bool $filter
     * @return array|null
     */
    public function post($para,$default=null,$filter=true){
        if(!($value = $this->posts([$para],$filter)[$para])){
            return $default;
        }else{
            return $value;
        }
    }

    /**
     * @param $paras
     * @return array|null
     */
    public function sessions($paras){
        $result = array();
        foreach ($paras as $para) {
            if(isset($_SESSION[$para])){
                $result[$para] = $_SESSION[$para];
            }else{
                return null;
            }
        }
        return $result;
    }

    /**
     * @param string $para
     * @param null $default
     * @return null|object
     */
    public function session($para="",$default=null){
        if(!($value = $this->sessions([$para])[$para])){
            return $default;
        }else{
            return $value;
        }
    }

    /**
     * @param array $arr
     */
    public function sessions_set($arr=[]){
        foreach ($arr as $key => $value) {
            $_SESSION[(string)$key] = $value;
        }
    }

    /**
     * @param string $key
     * @param null $value
     */
    public function session_set($key="", $value=null){
        $this->sessions_set([$key=>$value]);
    }
}