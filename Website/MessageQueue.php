<?php
include 'config.php';
class MessageQueue
{
    var $redis;
    var $Queuekey;
    function __construct($key)
    {
        global $config;
        $this->redis= new Redis();
        $this->redis->connect($config['REDIS_HOST'], $config['REDIS_PORT']);

        $this->Queuekey = $key;
    }

    function put($value){
        $this->redis->rPush($this->Queuekey,$value);
    }

    function get(){
        return $this->redis->blPop($this->Queuekey,10);
    }
}