<?php
namespace app\index\behavior;
/**
 * 保存用户的交易信息
 */
 class PayInfo{
 	function run(&$params){
 		$PayInfo=new \app\index\model\PayInfo();
 		$res=$PayInfo->savePayInfo($params);
 		return $res;
 	}
 }