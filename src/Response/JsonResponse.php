<?php

namespace Msoroka\Framework\Response;

/**
 * Class JsonResponse
 * @package Msoroka\Framework\Response
 */
class JsonResponse extends Response
{
    /**
     * JsonResponse constructor.
     * @param string $content
     * @param int $code
     */
    public function __construct(string $content, $code = 200)
    {
        parent::__construct($content, $code);
        $this->addHeader('Content-Type', 'application/json');
    }

    /**
     * Send content to client in JSON format
     */
    public function sendBody()
    {
        echo json_encode($this->playload);
    }
}