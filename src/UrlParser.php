<?php

/**
 * Created by PhpStorm.
 * User: mart496g
 * Date: 11-08-2015
 * Time: 09:47
 */
namespace Sicet7;
 
class UrlParser{
    private $_args = array(),
        $_getData = array(),
        $_count = 0;
    public function __construct($URI,$exclude = array()) {
        $parts = explode('/',$URI);
        array_shift($parts);
        foreach($parts as $arrayId => $part){
            if(isset($part) && !is_null($part) && !empty($part) && !in_array($part,$exclude)){
                if($arrayId == (count($parts)-1) && strstr($part,'?') !== false){
                    $gets = explode('&',trim(strstr($part,'?'),'?'));
                    foreach($gets as $get){
                        $keyNval = explode('=',$get);
                        $this->_getData[$keyNval[0]] = $keyNval[1];
                    }
                    $this->_args[] = strstr($part,'?',true);
                    $this->_count++;
                }else{
                    $this->_args[] = $part;
                    $this->_count++;
                }
            }
        }
    }
    public function getArgs($i = null){
        if(!is_null($i)){
            return $this->_args[$i];
        }
        return $this->_args;
    }
    public function getGets($name = null){
        if(!is_null($name)){
            return $this->_getData[$name];
        }
        return $this->_getData;
    }
    public function getCount(){
        return $this->_count;
    }
}
