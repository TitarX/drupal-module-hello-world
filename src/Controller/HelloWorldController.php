<?php

namespace Drupal\hello_world\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\hello_world\HelloWorldSalutationService;

/**
 * Controller for the salutation message
 */
class HelloWorldController extends ControllerBase
{
    /**
     * @var HelloWorldSalutationService
     */
    protected HelloWorldSalutationService $helloWorldSalutationService;

    /**
     * HelloWorldController construct
     *
     * @param HelloWorldSalutationService $helloWorldSalutationService
     */
    public function __construct(HelloWorldSalutationService $helloWorldSalutationService)
    {
        $this->helloWorldSalutationService = $helloWorldSalutationService;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container)
    {
        return new static($container->get('hello_world.salutation'));
    }

    /**
     * Hello World
     *
     * @return array
     */
    public function helloWorld()
    {
        $output = '';

        // Прямой вызов сервиса
        $helloWorldSalutationService = \Drupal::service('hello_world.salutation');
        $salutation = $helloWorldSalutationService->getSalutation('Call service directly: ');
        if (!empty($salutation)) {
            $output .= $salutation;
        }

        $output .= '<br>';

        // Вызов сервиса внедрённого в контроллер
        $output .= $this->helloWorldSalutationService->getSalutation('Invoke service injected controller: ');

        return [
            '#markup' => $output
        ];
    }

    /**
     * Hello World Node
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
