<?php

namespace Drupal\hello_world\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for the salutation message.
 */
class HelloWorldController extends ControllerBase
{
    /**
     * Hello World.
     *
     * @return array
     */
    public function helloWorld()
    {
        return [
            '#markup' => $this->t('Hello World content')
        ];
    }

    /**
     * Hello World Node.
     *
     * @return array
     */
    public function helloWorldNode($param)
    {
        $result = [];

        if (is_object($param) && method_exists($param, 'getTitle')) {
            $result['#markup'] = "Node title: {$param->getTitle()}";
        } else {
            // На самом деле, если нода не найдена, то ответ будут 404
            $result['#markup'] = 'Node not found';
        }

        return $result;
    }
}
