<?php
namespace app\index\controller;
/**
 * 所有能够直接访问的页面，并对每个页面进行访问统计
 */
use WX\JSSDK;
class Index extends \think\Controller
{
    /**
     * 初始化函数，用户访问统计
     * @return [type] [description]
     */
    public function _initialize(){

            //获取当前链接将要访问的页面
            // $params['page']=request()->action();
            // //访问计数钩子函数
            // if ($res=\think\Hook::listen('statistics',$params)) {
            //     if (!$res['0']) {
            //         //数据库写入失败，日志记录
            //         $this->error('写入数据库失败'.var_dump($res));
            //     }
            // }


        //如果是微信浏览器，则微信静默登录
        // if (strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')!==false) {
        //     $params['wx_openid']='0';
        //     //控制每次会话只静默登录一次
        //     if (!session('wxAutoLogin')) {
        //         action('Oauth/wxAutoLogin');
        //         //获取用户的wx_openid
        //     }
        //     if (session('wx_openid') && session('wxAutoLogin')) {
        //         $params['wx_openid']=session('wx_openid');
        //         session('wx_openid',null);
        //     }
        //     //获取当前链接将要访问的页面
        //     $params['page']=request()->action();
        //     //访问计数钩子函数
        //     if ($res=\think\Hook::listen('statistics',$params)) {
        //         if (!$res['0']) {
        //             //数据库写入失败，日志记录
        //         }
        //     }
        // }else{
        //     $this->error('请使用微信打开链接');
        // }
    }
    
    public function index()
    {   
        if (!session('user_openid')) {
            // $this->error('请先登录','index/suselogin');
        }
        //获取访问数
        $count=model('Count');
        $data=$count->getCount();
        $ip=request()->ip();

    	return view('index/index',['page'=>'index','count'=>$data,'ip'=>$ip]);
    }
    public function jquery(){
        return view('index/jquery',['page'=>'jquery']);
    }
    public function about()
    {    	
    	return view('index/about',['page'=>'about']);
    }
    public function single()
    {    	
    	return view('index/single',['page'=>'single']);
    }
    public function portfolio()
    {    	
    	return view('index/portfolio',['page'=>'portfolio']);
    }
    public function contact()
    {    	
    	return view('index/contact',['page'=>'contact']);
    }
    public function test()
    {    	
    	return view('index/test',['page'=>'test']);
    }
    public function test2()
    {    	
    	return view('index/test2',['page'=>'test2']);
    }
    public function login()
    {       
        return view('index/login',['page'=>'login']);
    }
    public function bindphone()
    {       
        return view('index/bindphone',['page'=>'bindphone']);
    }
    public function bindmail()
    {       
        return view('index/bindmail',['page'=>'bindmail']);
    }
    public function wait()
    {   
        $arr=array('state'=>9,'tag'=>'behavior',);
        $res=\think\Hook::listen('test',$arr);
        var_dump($res);
        return view('index/wait',['page'=>'wait']);
    }
    public function phonereg()
    {       
        return view('index/phonereg',['page'=>'phonereg']);
    }
    public function mailreg()
    {       
        return view('index/mailreg',['page'=>'mailreg']);
    }
    public function register()
    {       
        return view('index/register',['page'=>'register']);
    }
    public function phonelogin()
    {       
        return view('index/phonelogin',['page'=>'phonelogin']);
    }
    public function car()
    {       
        return view('index/car',['page'=>'car']);
    }
    public function suselogin()
    {       
        return view('index/suselogin',['page'=>'suselogin']);
    }
    public function more()
    {       
        return view('index/more',['page'=>'more']);
    }
    public function jcc()
    {       
        return view('index/jcc',['page'=>'jcc']);
    }
    public function jcclogin()
    {       
        return view('index/jcclogin',['page'=>'jcclogin']);
    }
    public function studentIdAnalysis()
    {       
        return view('index/studentIdAnalysis',['page'=>'studentIdAnalysis']);
    }
    public function showCourse()
    {   
        if (!session('user_openid')) {
            $this->error('请先登录','index/suselogin');
        }

        $suse_info=model('SuseInfo');
        $student_id=$suse_info->getStudentId(session('user_openid'));
        $student_id=json_decode(json_encode($student_id),true);
        $student_id=$student_id['student_id'];

        $course=model('CourseInfo');
        $list=$course->showCourse($student_id);
        $list=json_decode(json_encode($list),true);

        $student_info=model('StudentInfo');
        $student=$student_info->showStudent($student_id);
        $student=json_decode(json_encode($student),true);

        return view('index/showCourse',['page'=>'showCourse','list'=>$list,'vo1'=>$student]);
    }
    public function showAchievement()
    {   
        if (!session('user_openid')) {
            $this->error('请先登录','index/suselogin');
        }

        $suse_info=model('SuseInfo');
        $student_id=$suse_info->getStudentId(session('user_openid'));
        $student_id=json_decode(json_encode($student_id),true);
        $student_id=$student_id['student_id'];

        $achievement=model('Achievement');
        $list=$achievement->showAchievement($student_id);
        $list=json_decode(json_encode($list),true);

        return view('index/showAchievement',['page'=>'showAchievement','list'=>$list]);
    }

    public function showCredit()
    {   
        $suse_info=model('SuseInfo');
        $student_id=$suse_info->getStudentId(session('user_openid'));
        $student_id=json_decode(json_encode($student_id),true);
        $student_id=$student_id['student_id'];

        $credit=model('Credit');
        $list2=$credit->showCredit($student_id);
        $list2=json_decode(json_encode($list2),true);

        $credit_info=model('CreditPoints');
        $list1=$credit_info->showCreditPoints($student_id);
        $list1=json_decode(json_encode($list1),true);

        return view('index/showCredit',['page'=>'showCredit','list1'=>$list1,'list2'=>$list2]);
    }
    public function xynews()
    {   
        if (!session('user_openid')) {
            // $this->error('请先登录','index/suselogin');
        }
        if (input('get.op')) {
            $xy=input('get.op');
        }else{
            $xy='jsj';
        }
        $jsjnews = model('NewsInfo');
        $list=$jsjnews->showList($xy);
        $list=json_decode(json_encode($list),true);

        $xy_name=getXyName($xy);

        return view('index/xynews',['page'=>'jsjnews','list'=>$list,'xy_name'=>$xy_name]);
    }

    public function suse()
    {       
        return view('index/suse',['page'=>'suse']);
    }
    public function wxjssdk()
    {   
        $jssdk = new JSSDK(config('wx_appid'), config('wx_appsecret'));
        $signPackage = $jssdk->GetSignPackage();
        return view('index/wxjssdk',['page'=>'wxjssdk','signPackage'=>$signPackage]);
    }
    public function jstest(){
        $jssdk = new JSSDK(config('wx_appid'), config('wx_appsecret'));
        $signPackage = $jssdk->GetSignPackage();
        return view('index/jstest',['page'=>'jstest','signPackage'=>$signPackage]);
    }
    /**
     * 支付模板
     * @return [type] [description]
     */
    public function wxpay()
    {   
        $res=action('Wxpay/pay'); 
        
        $total_fee=session('total_fee');
        $unit=100;
        $total_fee=$total_fee/$unit;
        session('total_fee',null);
        
        return view('index/wxpay',['page'=>'wxpay','total_fee'=>$total_fee,'jsApiParameters'=>$res['jsApiParameters'],'editAddress'=>$res['editAddress']]);
    }


    /******************有赞*****************/

    public function youzan()
    {   
        return view('youzan/index',['page'=>'index']);
    }

}
