<?php

namespace Msoroka\Framework\Response;

/**
 * Class RedirectResponse
 * @package Msoroka\Framework\Response
 */
class RedirectResponse extends Response
{
    /**
     * RedirectResponse constructor.
     * @param string $redirect_uri
     * @param int $code
     */
    public function __construct($redirect_uri, $code = 301)
    {
        $this->code = $code;
        $this->addHeader('Location', $redirect_uri);
    }

    public function sendBody()
    {
        //Body is not needed for redirect
    }

}