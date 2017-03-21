<?php

namespace Msoroka\Framework\Renderer;

/**
 * Class Renderer
 *
 * @package Msoroka\Framework\Renderer
 */
class Renderer
{
    public static function render(string $path_to_view, array $params = []): string
    {
        ob_start();
        extract($params);
        include $path_to_view;

        return ob_get_clean();
    }
}