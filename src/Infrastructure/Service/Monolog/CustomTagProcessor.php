<?php

declare(strict_types=1);

namespace AdgoalCommon\Base\Infrastructure\Service\Monolog;

use AdgoalCommon\Base\Domain\Exception\AlertException;
use AdgoalCommon\Base\Domain\Exception\CriticalException;
use AdgoalCommon\Base\Domain\Exception\EmergencyException;
use Error;
use Monolog\Processor\ProcessorInterface;
use RuntimeException;
use Throwable;
use TypeError;

/**
 * Class CustomTagProcessor.
 *
 * @category AdgoalCommon\Datagate\Infrastructure\Service\Monolog
 */
class CustomTagProcessor implements ProcessorInterface
{
    private const EXCEPTION_NAME_ALERT = 'Alert';
    private const EXCEPTION_NAME_CRITICAL = 'Critical';
    private const EXCEPTION_NAME_EMERGENCY = 'Emergency';
    private const EXCEPTION_NAME_RUNTIME = 'Runtime';
    private const EXCEPTION_NAME_DEFAULT = 'Exception';
    private const ERROR_BASE_NAME = 'Error';
    private const ERROR_NAME_TYPE = 'TypeError';

    /**
     * @var string
     */
    private $environment;

    /**
     * @var string
     */
    private $release;

    /**
     * @var mixed[]
     */
    private $tags;

    /**
     * @var mixed[]
     */
    private $globalTags;

    /**
     * @var string[]
     */
    private $watchedTags;

    /**
     * CustomTagProcessor constructor.
     *
     * @param string   $environment
     * @param string   $release
     * @param mixed[]  $globalTags
     * @param string[] $watchedTags
     */
    public function __construct(string $environment, string $release, array $globalTags = [], array $watchedTags = [])
    {
        $this->release = $release;
        $this->environment = $environment;
        $this->globalTags = $globalTags;
        $this->watchedTags = $watchedTags;
    }

    /**
     * Add custom tags to log tags. Method called by Monolog.
     *
     * @param mixed[] $record
     *
     * @return mixed[]
     */
    public function __invoke(array $record): array
    {
        $this->addWatchedTags($record);
        $this->addGlobalTags($record);
        $record['extra']['tags'] = $this->tags;
        $record['extra']['release'] = $this->release;
        $record['extra']['environment'] = $this->environment;

        return $record;
    }

    /**
     * @param mixed[] $record
     */
    protected function addGlobalTags(array $record): void
    {
        $context = $record['context'];

        if (isset($context['exception'])) {
            $this->addTag('exception_type', $this->resolveExceptionLevelType($context['exception']));
        }

        $this->addTag('php_version', (string) phpversion());

        foreach ($this->globalTags as $k => $v) {
            $this->addTag($k, $v);
        }
    }

    /**
     * @param mixed[] $record
     */
    protected function addWatchedTags(array $record): void
    {
        $context = $record['context'];

        foreach ($this->watchedTags as $key) {
            if (isset($context[$key])) {
                $this->addTag($key, $context[$key]);
            }
        }
    }

    /**
     * @param string $key
     * @param mixed  $value
     */
    protected function addTag(string $key, $value): void
    {
        if (is_object($value)) {
            $value = method_exists($value, 'normalize') ? json_encode($value->normalize()) : var_export($value, true);
        }
        $this->tags[$key] = $value;
    }

    /**
     * Resolve exception level type based on exception.
     *
     * @param Throwable $e
     *
     * @return string
     */
    private function resolveExceptionLevelType(Throwable $e): string
    {
        switch (true) {
            case $e instanceof AlertException:
                return self::EXCEPTION_NAME_ALERT;

            case $e instanceof CriticalException:
                return self::EXCEPTION_NAME_CRITICAL;

            case $e instanceof EmergencyException:
                return self::EXCEPTION_NAME_EMERGENCY;

            case $e instanceof RunTimeException:
                return self::EXCEPTION_NAME_RUNTIME;

            case $e instanceof TypeError:
                return self::ERROR_NAME_TYPE;

            case $e instanceof Error:
                return self::ERROR_BASE_NAME;

            default:
                return self::EXCEPTION_NAME_DEFAULT;
        }
    }
}
