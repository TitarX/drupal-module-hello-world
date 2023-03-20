<?php

namespace Drupal\hello_world;

use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Prepare the salutation to the world
 */
class HelloWorldSalutationService
{
    use StringTranslationTrait;

    /**
     * Returns salutation
     */
    public function getSalutation(string $prefix = '')
    {
        $time = new \DateTime();
        if ((int)$time->format('G') >= 00 && (int)$time->format('G') < 12) {
            return $this->t("{$prefix}Good morning world");
        }

        if ((int)$time->format('G') >= 12 && (int)$time->format('G') < 18) {
            return $this->t("{$prefix}Good afternoon world");
        }

        if ((int)$time->format('G') >= 18) {
            return $this->t("{$prefix}Good evening world");
        }
    }
}
