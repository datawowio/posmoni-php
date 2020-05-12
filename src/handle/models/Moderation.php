<?php

require_once dirname(__FILE__)."/../shared/BaseCommon.php";
require_once dirname(__FILE__)."/../connections/Connector.php";

class Moderation extends Connector
{
    public static function create($token, $params = array())
    {
        return parent::create_data(get_class(), base_url("moderations"), $token, json_encode($params));
    }

    public static function get($token, $params = array())
    {
        $params = array("query" => "");

        return parent::retrieve_list(get_class(), base_url("moderations"), $token, json_encode($params));
    }
}
