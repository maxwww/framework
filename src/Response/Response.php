<?php

namespace Msoroka\Framework\Response;

/**
 * Class Response
 * @package Msoroka\Framework\Response
 */
class Response
{
    /**
     * @var int Response code
     */
    public $code = 200;

    /**
     * HTTP Status messages
     */
    const STATUS_MSGS = [
        '200' => 'Ok',
        '301' => 'Moved permanently',
        '302' => 'Moved temporary',
        '401' => 'Auth required',
        '403' => 'Access denied',
        '404' => 'Not found',
        '500' => 'Server error',
    ];

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $playload = '';

    /**
     * Response constructor.
     * @param string $content
     * @param int $code
     */
    public function __construct(string $content, $code = 200)
    {
        $this->setPlayload($content);
        $this->code = $code;
        $this->addHeader('Content-Type', 'text/html');
    }

    /**
     * Add header
     *
     * @param string $key
     * @param string $value
     */
    public function addHeader(string $key, string $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Set Playload
     *
     * @param string $content
     */
    public function setPlayload(string $content)
    {
        $this->playload = $content;
    }

    /**
     * Send Response
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendBody();
        exit();
    }

    /**
     * Send Headers
     */
    public function sendHeaders()
    {
        header($_SERVER['SERVER_PROTOCOL'] . ' ' . $this->code . ' ' . self::STATUS_MSGS[$this->code]);
        if (!empty($this->headers)) {
            foreach ($this->headers as $key => $value) {
                header($key . ': ' . $value);
            }
        }
    }

    public function sendBody()
    {
        echo $this->playload;
    }

}