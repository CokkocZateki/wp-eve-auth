<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of wp_eve_auth_api
 * 
 * @author vooders
 */
class wp_eve_auth_api {
    private $uri_prefix = 'https://api.eveonline.com';
       
    public function get_corp_sheet($vcode, $key_id){
        $url = $this->uri_prefix . '/corp/CorporationSheet.xml.aspx';
        $myvars = 'vcode=' . $vcode . '&keyID=' . $key_id;

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec( $ch );
        
        $corp_sheet = new SimpleXMLElement($response);
        
        return $corp_sheet;         
    }    
}