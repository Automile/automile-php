<?php

namespace Automile\Sdk\Tests\Integration\HttpClient;

use Automile\Sdk\HttpClient\Client\CurlAdapter;


/**
 * CurlAdapter Mock class
 */
class CurlAdapterMock extends CurlAdapter
{

    /**
     * @var string
     */
    private $_url;

    /**
     * @var string
     */
    private $_mockResponse = '';

    /**
     * @var array
     */
    private $_options = [];

    /**
     * @var array
     */
    private $_mockInfo = [];

    /**
     * @var string
     */
    private $_mockError = '';

    /**
     * @param string $response
     * @return bool
     */
    public function setMockResponse($response)
    {
        $this->_mockResponse = $response;
        return true;
    }

    /**
     * @param array $info
     * @return bool
     */
    public function setMockInfo(array $info)
    {
        $this->_mockInfo = $info;
        return true;
    }

    /**
     * @param string $url
     * @return null
     */
    public function curlInit($url = null)
    {
        $this->_url = $url;

        return parent::curlInit($url);
    }

    /**
     * @param resource $curl
     * @param int $option
     * @param mixed $value
     * @return bool
     */
    public function curlSetopt($curl, $option, $value)
    {
        $this->_options[$option] = $value;

        return parent::curlSetopt($curl, $option, $value);
    }

    /**
     * @param resource $curl
     * @return mixed
     */
    public function curlExec($curl)
    {
        return $this->_mockResponse;
    }

    /**
     * @param resource $curl
     * @param int $opt
     * @return mixed
     */
    public function curlGetInfo($curl, $opt = null)
    {
        return empty($this->_mockInfo[$opt]) ? null : $this->_mockInfo[$opt];
    }

    /**
     * @param resource $curl
     * @return string
     */
    public function curlGetError($curl)
    {
        return $this->_mockError;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

}
