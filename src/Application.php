<?php

namespace Msoroka\Framework;

/**
 * Class Application
 * Msoroka Framework application instance class
 *
 * @package Msoroka\Framework
 */
class Application
{
    /**
     * @var array App config
     */
    public $config =[];

    /**
     * Application constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        $this->config = $config;
    }

    /**
     * Process the request
     */
    public function run()
    {
        echo "Application->run()";
    }

}
