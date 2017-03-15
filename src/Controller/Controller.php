<?php

namespace Msoroka\Framework\Controller;

use Msoroka\Framework\Renderer\Renderer;
use Msoroka\Framework\Response\Response;

/**
 * Class Controller
 * @package Msoroka\Framework\Controller
 */
class Controller
{
    /**
     * @param string $view_path
     * @param array $params
     * @param bool $with_layout
     * @return Response
     */
    public function render(string $view_path, array $params = [], bool $with_layout = true): Response
    {
        $content = Renderer::render($view_path, $params);

        if ($with_layout) {
            $content = Renderer::render(
                pathinfo($view_path)['dirname'] . DIRECTORY_SEPARATOR  . 'layout.html.php',
                ['content' => $content]
            );
        }

        return new Response($content);
    }
}