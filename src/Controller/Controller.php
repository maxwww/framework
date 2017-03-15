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
     * Path to layout. Can be changed in Controller
     *
     * @var string
     */
    protected $layout = '';

    /**
     * @param array $params
     * @param bool $with_layout
     * @return Response
     */
    public function render(string $name, array $params = [], bool $with_layout = true): Response
    {
        $class_name = get_class($this);
        preg_match("/[\w]+(?=Controller$)/", $class_name, $output_array);
        $class_name = $output_array[0];
        $class_name = strtolower($class_name);
        $view_path = realpath("../src/Views/$class_name/$name.php");
        $content = Renderer::render($view_path, $params);

        if ($with_layout) {
            if ($this->layout == '') {
                $this->layout = realpath("../src/Views/layouts/main.php");
            }
            $content = Renderer::render($this->layout, ['content' => $content]);
        }

        return new Response($content);
    }
}