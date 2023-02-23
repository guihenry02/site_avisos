<?php
defined("BASEPATH") OR exit('No direct script acess allowrd');

if(!function_exists('set_msg')):

    function set_msg($msg=null){
        $ci = & get_instance();
        $ci->session->set_userdata('aviso', $msg);
    }
endif;

if(!function_exists('get_msg')):
    //retorna uma mensagem definida pela função set_msg
    function get_msg($destroy=TRUE){
        $ci = & get_instance();
        $retorno = $ci->session->userdata("aviso");
        if($destroy) $ci -> session -> unset_userdata('aviso');
        return $retorno;
    }

endif;