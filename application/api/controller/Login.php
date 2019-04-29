<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\library\Ems;
use app\common\library\Sms;
use fast\Random;
use think\Validate;

/**
 * 会员接口
 */
class Login extends Api
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\Wechat;
    }

    public function index(){
        $code = $this->request->request('code');
        $userInfo = $this->request->request('userinfo');
        $userInfo = json_decode($userInfo,true);
        $openid = $this->Wx_GetOpenidByCode($code);

        //查找小程序用户是否已存在
        $user = model('WechatUser')->where('openid',$openid)->find();
        $arr = array();
        if (empty($user)) {
            //注册本站用户
            $info = $this->register();
            $user_id = $info['userinfo']['id'];

            //关联小程序用户
            $data = array(
                    'user_id' => $user_id,
                    'openid' => $openid,
                    'nickname' => $this->emoji_encode($userInfo['nickName']),
                    'gender' => $userInfo['gender'],
                    'language' => $userInfo['language'],
                    'city' => $userInfo['city'],
                    'province' => $userInfo['province'],
                    'country' => $userInfo['country'],
                    'headimgurl' => $userInfo['avatarUrl']
                );

            model('WechatUser')->save($data);
            $weid = model('WechatUser')->id;
            $arr['userinfo'] = model('WechatUser')->where('id',$weid)->find();
            //反译微信昵称
            $arr['userinfo']['nickname'] = $this->emoji_decode($arr['userinfo']['nickname']);
            $arr['uid'] = $user_id;
            $arr['openid'] = $openid;
        }else{
        	$arr['userinfo'] = $user;
            //反译微信昵称
            $arr['userinfo']['nickname'] = $this->emoji_decode($arr['userinfo']['nickname']);
            $arr['uid'] = $user['user_id'];
            $arr['openid'] = $arr['userinfo']['openid'];
        }

        $this->success(__('Sign up successful'), $arr);
    }

    function Wx_GetOpenidByCode($code){
        $wehcatInfo = $this->model->where('id',1)->find();
        $appid = $wehcatInfo['appid'];
        $secret = $wehcatInfo['secret'];
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=$appid&secret=$secret&js_code=$code&grant_type=authorization_code";
        //通过code换取网页授权access_token
        $weixin =  file_get_contents($url);
        $jsondecode = json_decode($weixin); //对JSON格式的字符串进行编码
        $array = get_object_vars($jsondecode);//转换成数组
        $openid = $array['openid'];//输出openid
        return $openid;
    }

    function emoji_encode($str){
        $strEncode = '';
 
        $length = mb_strlen($str,'utf-8');
 
        for ($i=0; $i < $length; $i++) {
            $_tmpStr = mb_substr($str,$i,1,'utf-8');
            if(strlen($_tmpStr) >= 4){
                $strEncode .= '[[EMOJI:'.rawurlencode($_tmpStr).']]';
            }else{
                $strEncode .= $_tmpStr;
            }
        }
 
        return $strEncode;
    }

    function refresh()
    {
        //删除源Token
        $token = $this->auth->getToken();
        \app\common\library\Token::delete($token);
        //创建新Token
        $token = Random::uuid();
        \app\common\library\Token::set($token, $this->auth->id, 2592000);
        $tokenInfo = \app\common\library\Token::get($token);
        // $this->success('', ['token' => $tokenInfo['token'], 'expires_in' => $tokenInfo['expires_in']]);
        return $tokenInfo['token'];
    }

    //对emoji表情转反义
    function emoji_decode($str){
        $strDecode = preg_replace_callback('|\[\[EMOJI:(.*?)\]\]|', function($matches){
            return rawurldecode($matches[1]);
        }, $str);
        return $strDecode;
    }

    /**
     * 注册会员
     * 
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $email 邮箱
     * @param string $mobile 手机号
     */
    function register()
    {
        $username = $this->rand_user_name();
        $password = '123456789';
        $email = $username.'@fa.com';
        $mobile = '';
        if (!$username || !$password)
        {
            $this->error(__('Invalid parameters'));
        }
        if ($email && !Validate::is($email, "email"))
        {
            $this->error(__('Email is incorrect'));
        }
        if ($mobile && !Validate::regex($mobile, "^1\d{10}$"))
        {
            $this->error(__('Mobile is incorrect'));
        }
        $ret = $this->auth->register($username, $password, $email, $mobile, []);
        if ($ret)
        {
            $data = ['userinfo' => $this->auth->getUserinfo()];
            return $data;
        }
        else
        {
            return false;
        }
    }

    //随机字符串
    function rand_user_name(){
        $name_time = 'wxapp_'.date('Ymdhi',time());
        
        do{
            $name = $name_time.mt_rand(1111,9999);
            $is_name = model("user")->where('username',$name)->find();
            if (!empty($is_name)) {
                $err = 1;
            }else{
                $err = 0;
            }
        }while($err == 1);

        return $name;
    }

}
