<?php

namespace Automile\Sdk\HttpClient\Client;

/**
 * Encapsulates cURL calls
 */
class CurlAdapter
{

    /**
     * @param string $url
     * @return resource
     */
    public function curlInit($url = null)
    {
        return curl_init($url);
    }

    /**
     * @param resource $curl
     * @param int $option
     * @param mixed $value
     * @return bool
     */
    public function curlSetopt($curl, $option, $value)
    {
        curl_setopt($curl, $option, $value);
        return true;
    }

    /**
     * @param resource $curl
     * @return mixed
     */
    public function curlExec($curl)
    {
        return curl_exec($curl);
    }

    /**
     * @param resource $curl
     * @param int $opt
     * @return mixed
     */
    public function curlGetInfo($curl, $opt = null)
    {
        return curl_getinfo($curl, $opt);
    }

    /**
     * @param resource $curl
     * @return string
     */
    public function curlGetError($curl)
    {
        return curl_error($curl);
    }

}
