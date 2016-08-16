<?php

namespace Drupal\d8cards\Controller;
 
class D8CardsController {
    public function d8cards() {
      return array(
           '#title' => 'D8 Cards Example',
           '#markup' => 'Here is some content.',
       );
    }
}