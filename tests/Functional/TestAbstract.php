<?php

namespace Automile\Sdk\Tests\Functional;


use Automile\Sdk\AutomileClient;
use PHPUnit\Framework\TestCase;
use Automile\Sdk\Config;

/**
 * Base methods and interface for functional tests
 * @package Automile\Sdk\Tests\Functional
 */
abstract class TestAbstract extends TestCase
{

    const STORAGE_PATH = 'data/token.json';

    /**
     * @var array
     */
    private static $_settings;

    /**
     * @var AutomileClient
     */
    private static $_client;

    /**
     * retrieve settings
     * @param string $key use dot to separate levels: 'level1.level2.level3'
     * @return mixed
     * @throws TestException
     */
    protected static function _getSettings($key)
    {
        if (null === self::$_settings) {
            self::$_settings = self::_loadSettings();
        }

        $keys = explode('.', $key);
        $settings = self::$_settings;
        foreach ($keys as $key) {
            if (is_array($settings) && array_key_exists($key, $settings)) {
                $settings = $settings[$key];
            } else {
                throw new TestException("Settings key '{$key}' not found");
            }
        }

        return $settings;
    }

    protected static function _getClient()
    {
        if (null === self::$_client) {
            Config::setUsername(self::_getSettings('client.username'));
            Config::setPassword(self::_getSettings('client.password'));
            Config::setApiClient(self::_getSettings('client.api_client'));
            Config::setApiSecret(self::_getSettings('client.api_secret'));

            $client = AutomileClient::fromSavedToken(__DIR__ . '/' . self::STORAGE_PATH);
            $client->saveToken(__DIR__ . '/' . self::STORAGE_PATH);

            self::$_client = $client;
        }

        return self::$_client;
    }

    /**
     * @return array
     * @throws TestException
     */
    private static function _loadSettings()
    {
        $config = __DIR__ . '/config.json';
        if (!file_exists($config)) {
            throw new TestException("Config file not found");
        }

        $settings = json_decode(file_get_contents($config), true);
        if (!$settings) {
            throw new TestException("Settings not found");
        }

        return $settings;
    }

}
