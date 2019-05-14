<?php

namespace DrupalCodeGenerator\Tests\Generator\Drupal_7;

use DrupalCodeGenerator\Tests\Generator\BaseGeneratorTest;

/**
 * Test for d7:theme-info-file command.
 */
class ThemeInfoGeneratorTest extends BaseGeneratorTest {

  protected $class = 'Drupal_7\ThemeInfo';

  protected $interaction = [
    'Theme name [%default_name%]:' => 'Bar',
    'Theme machine name [bar]:' => 'bar',
    'Theme description [A simple Drupal 7 theme.]:' => 'Theme description',
    'Base theme:' => 'omega',
  ];

  protected $fixtures = [
    'bar.info' => __DIR__ . '/_theme.info',
  ];

}