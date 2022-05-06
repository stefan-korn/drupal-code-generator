<?php declare(strict_types=1);

namespace DrupalCodeGenerator\Tests\Functional\Generator\Test;

use DrupalCodeGenerator\Command\Test\Kernel;
use DrupalCodeGenerator\Test\Functional\GeneratorTestBase;

/**
 * Tests test:kernel generator.
 */
final class KernelTest extends GeneratorTestBase {

  protected string $fixtureDir = __DIR__ . '/_kernel';

  public function testGenerator(): void {

    $this->execute(new Kernel(), ['foo', 'ExampleTest']);

    $expected_display = <<< 'TXT'

     Welcome to kernel-test generator!
    –––––––––––––––––––––––––––––––––––

     Module machine name [%default_name%]:
     ➤ 

     Class [ExampleTest]:
     ➤ 

     The following directories and files have been created or updated:
    –––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––––
     • tests/src/Kernel/ExampleTest.php

    TXT;
    $this->assertDisplay($expected_display);

    $this->assertGeneratedFile('tests/src/Kernel/ExampleTest.php');
  }

}