<?php declare(strict_types=1);

namespace DrupalCodeGenerator\Asset;

use DrupalCodeGenerator\Asset\Resolver\ResolverInterface;
use DrupalCodeGenerator\Style\GeneratorStyleInterface;
use DrupalCodeGenerator\Utils;

/**
 * Base class for assets.
 */
abstract class Asset {

  protected const RESOLVER_ACTION_PRESERVE = 'preserve';
  protected const RESOLVER_ACTION_REPLACE = 'replace';

  /**
   * Indicates that the asset should not be dumped.
   */
  private bool $virtual = FALSE;

  /**
   * Asset mode.
   */
  private int $mode;

  /**
   * Template variables.
   *
   * @var array
   */
  private array $vars = [];

  /**
   * Content resolver.
   */
  protected ?ResolverInterface $resolver = NULL;

  /**
   * Suggested resover action.
   */
  protected string $resolverAction = self::RESOLVER_ACTION_REPLACE;

  /**
   * Asset constructor.
   */
  public function __construct(readonly protected string $path) {}

  /**
   * Getter for the asset path.
   */
  final public function getPath(): string {
    return $this->replaceTokens($this->path);
  }

  /**
   * Getter for the asset mode.
   */
  final public function getMode(): int {
    return $this->mode;
  }

  /**
   * Getter for the asset vars.
   */
  final public function getVars(): array {
    return $this->vars;
  }

  /**
   * Checks if the asset is virtual.
   */
  final public function isVirtual(): bool {
    return $this->virtual;
  }

  /**
   * Returns the asset resolver.
   */
  abstract public function getResolver(GeneratorStyleInterface $io): ResolverInterface;

  /**
   * Setter for asset mode.
   */
  final public function mode(int $mode): Asset {
    if ($mode < 0000 || $mode > 0777) {
      throw new \InvalidArgumentException("Incorrect mode value $mode.");
    }
    $this->mode = $mode;
    return $this;
  }

  /**
   * Setter for the asset vars.
   */
  final public function vars(array $vars): self {
    $this->vars = $vars;
    return $this;
  }

  /**
   * Makes the asset "virtual".
   */
  final public function setVirtual(bool $virtual): self {
    $this->virtual = $virtual;
    return $this;
  }

  /**
   * Indicates that existing asset should be replaced.
   */
  public function replaceIfExists(): self {
    $this->resolverAction = self::RESOLVER_ACTION_REPLACE;
    return $this;
  }

  /**
   * Indicates that existing asset should be preserved.
   */
  public function preserveIfExists(): self {
    $this->resolverAction = self::RESOLVER_ACTION_PRESERVE;
    return $this;
  }

  /**
   * Implements the magic __toString() method.
   */
  final public function __toString(): string {
    return $this->getPath();
  }

  /**
   * Setter for asset resolver.
   */
  final public function resolver(ResolverInterface $resolver): self {
    $this->resolver = $resolver;
    return $this;
  }

  /**
   * Replaces all tokens in a given string with appropriate values.
   */
  final protected function replaceTokens(string $text): ?string {
    return Utils::replaceTokens($text, $this->vars);
  }

}
