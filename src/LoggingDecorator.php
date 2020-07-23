<?php

declare(strict_types=1);

namespace Ground\NewRelic;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Throwable;

final class LoggingDecorator implements NewRelicInterface
{
    /**
     * @var NewRelicInterface
     */
    private $newRelic;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param NewRelicInterface $newRelic
     * @param LoggerInterface|null $logger
     */
    public function __construct(NewRelicInterface $newRelic, ?LoggerInterface $logger = null)
    {
        $this->newRelic = $newRelic;

        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * {@inheritDoc}
     */
    public function setApplicationName(string $name, ?string $license = null, bool $xmit = false): bool
    {
        $this->logger->debug('Setting New Relic Application name to {name}', ['name' => $name]);

        return $this->newRelic->setApplicationName($name, $license, $xmit);
    }

    /**
     * {@inheritDoc}
     */
    public function setTransactionName(string $name): bool
    {
        $this->logger->debug('Setting New Relic Transaction name to {name}', ['name' => $name]);

        return $this->newRelic->setTransactionName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function ignoreTransaction(): void
    {
        $this->logger->debug('Ignoring transaction');

        $this->newRelic->ignoreTransaction();
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomEvent(string $name, array $attributes): void
    {
        $this->logger->debug('Adding custom New Relic event {name}', ['name' => $name, 'attributes' => $attributes]);

        $this->newRelic->addCustomEvent($name, $attributes);
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomMetric(string $name, float $value): bool
    {
        $this->logger->debug('Adding custom New Relic metric {name}: {value}', ['name' => $name, 'value' => $value]);

        return $this->newRelic->addCustomMetric($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomParameter(string $name, $value): bool
    {
        $this->logger->debug('Adding custom New Relic parameters {name}: {value}', ['name' => $name, 'value' => $value]);

        return $this->newRelic->addCustomParameter($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBrowserTimingHeader(bool $includeTags = true): string
    {
        $this->logger->debug('Getting New Relic RUM timing header');

        return $this->newRelic->getBrowserTimingHeader($includeTags);
    }

    /**
     * {@inheritDoc}
     */
    public function getBrowserTimingFooter(bool $includeTags = true): string
    {
        $this->logger->debug('Getting New Relic RUM timing footer');

        return $this->newRelic->getBrowserTimingFooter($includeTags);
    }

    /**
     * {@inheritDoc}
     */
    public function disableAutoRUM(): void
    {
        $this->logger->debug('Disabling New Relic Auto-RUM');

        $this->newRelic->disableAutoRUM();
    }

    /**
     * {@inheritDoc}
     */
    public function noticeError(
        int $errNo,
        string $errStr,
        ?string $errFile = null,
        ?int $errLine = null,
        ?string $errContext = null
    ): void {
        $this->logger->debug('Sending notice error to New Relic', [
            'error_code' => $errNo,
            'message' => $errStr,
            'file' => $errFile,
            'line' => $errLine,
            'context_error' => $errContext,
        ]);

        $this->newRelic->noticeError($errNo, $errStr, $errFile, $errLine, $errContext);
    }

    /**
     * {@inheritDoc}
     */
    public function noticeThrowable(Throwable $e, ?string $message = null): void
    {
        $this->logger->debug('Sending exception to New Relic', [
            'message' => $message,
            'exception' => $e,
        ]);

        $this->newRelic->noticeThrowable($e, $message);
    }

    /**
     * {@inheritDoc}
     */
    public function enableBackgroundJob(): void
    {
        $this->logger->debug('Enabling New Relic background job');

        $this->newRelic->enableBackgroundJob();
    }

    /**
     * {@inheritDoc}
     */
    public function disableBackgroundJob(): void
    {
        $this->logger->debug('Disabling New Relic background job');

        $this->newRelic->disableBackgroundJob();
    }

    /**
     * {@inheritDoc}
     */
    public function endTransaction(bool $ignore = false): bool
    {
        $this->logger->debug('Ending a New Relic transaction');

        return $this->newRelic->endTransaction($ignore);
    }

    /**
     * {@inheritDoc}
     */
    public function startTransaction(?string $name = null, ?string $license = null): bool
    {
        $this->logger->debug('Starting a new New Relic transaction for app {name}', ['name' => $name]);

        return $this->newRelic->startTransaction($name, $license);
    }

    /**
     * {@inheritDoc}
     */
    public function excludeFromApdex(): void
    {
        $this->logger->debug('Excluding current transaction from New Relic Apdex score');

        $this->newRelic->excludeFromApdex();
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomTracer(string $name): bool
    {
        $this->logger->debug('Adding custom New Relic tracer', ['name' => $name]);

        return $this->newRelic->addCustomTracer($name);
    }

    /**
     * {@inheritDoc}
     */
    public function setCaptureParams(bool $enabled): void
    {
        $this->logger->debug('Toggle New Relic capture params to {enabled}', ['enabled' => $enabled]);

        $this->newRelic->setCaptureParams($enabled);
    }

    /**
     * {@inheritDoc}
     */
    public function stopTransactionTiming(): void
    {
        $this->logger->debug('Stopping New Relic timing');

        $this->newRelic->stopTransactionTiming();
    }

    /**
     * {@inheritDoc}
     */
    public function recordDataStoreSegment(callable $func, array $parameters)
    {
        $this->logger->debug('Adding custom New Relic datastore segment', [
            'parameters' => $parameters,
        ]);

        $this->newRelic->recordDatastoreSegment($func, $parameters);
    }

    /**
     * {@inheritDoc}
     */
    public function setUserAttributes(string $userValue, string $accountValue, string $productValue): bool
    {
        $this->logger->debug('Setting New Relic user attributes', [
            'user_value' => $userValue,
            'account_value' => $accountValue,
            'product_value' => $productValue,
        ]);

        return $this->newRelic->setUserAttributes($userValue, $accountValue, $productValue);
    }
}
