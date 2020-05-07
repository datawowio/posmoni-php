<?php

class Connector
{
    const REQ_GET = 'GET';
    const REQ_POST = 'POST';

    protected static function getInstance($className)
    {
        if (class_exists($className)) {
            return new $className();
        }

        throw new Exception('Class name not found!!');
    }

    protected static function create_data($className, $url, $token, $params = array(), $header = null)
    {
        $caller = call_user_func(array($className, 'getInstance'), $className);
        $result = $caller->_curl_excutor(self::REQ_POST, $url, $token, $params, $header);

        return $result;
    }

    protected static function retrieve_list($className, $url, $token, $params = array(), $header = null)
    {
        $caller = call_user_func(array($className, 'getInstance'), $className);
        $result = $caller->_curl_excutor(self::REQ_GET, $url, $token, $params, $header);

        return $result;
    }


    protected static function retrieve_once($className, $url, $token, $id, $query_str = false, $header = null)
    {
        $caller = call_user_func(array($className, 'getInstance'), $className);
        if ($query_str) {
            $result = $caller->_curl_excutor(self::REQ_GET, $url, $token, array('id' => $id), $header);
        } else {
            $result = $caller->_curl_excutor(self::REQ_GET, $url.$id, $token, array(), $header);
        }

        return $result;
    }

    private function _curl_excutor($method, $url, $token, $params = null, $header = null)
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, $this->_curl_options($method, $token, $params, $header));

        $result = curl_exec($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) >= 400) {
            curl_close($ch);

            throw new Exception(json_encode(array('message' => $result)));
        }

        curl_close($ch);

        return $result;
    }

    private function _curl_options($method, $token, $params = null, $header = null)
    {
        $options = array(
          CURLOPT_AUTOREFERER => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLINFO_HEADER_OUT => true,
          CURLOPT_CONNECTTIMEOUT => 30,
          CURLOPT_TIMEOUT => 60,
          CURLOPT_HEADER => false,
          CURLOPT_CUSTOMREQUEST => $method,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_HTTPHEADER => array("Authorization: $token","Accept: application/json", "Content-Type: application/json"),
          CURLOPT_POSTFIELDS => $params,
          CURLOPT_USERAGENT => 'Posmoni/0.1.0rc/PHP'.phpversion()
        );

        return $options;
    }
}
