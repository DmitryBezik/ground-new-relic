<?php

declare(strict_types=1);

namespace Ground\NewRelic;

use Throwable;

final class Adaptive implements NewRelicInterface
{
    /**
     * @var NewRelicInterface
     */
    private $newRelic;

    public function __construct(NewRelicInterface $real, NewRelicInterface $fake)
    {
        // phpcs:ignore WebimpressCodingStandard.PHP.ImportInternalFunction.ImportFQN
        $this->newRelic = \extension_loaded('newrelic') ? $real : $fake;
    }

    /**
     * {@inheritDoc}
     */
    public function setApplicationName(string $name, ?string $license = null, bool $xmit = false): bool
    {
        return $this->newRelic->setApplicationName($name, $license, $xmit);
    }

    /**
     * {@inheritDoc}
     */
    public function setTransactionName(string $name): bool
    {
        return $this->newRelic->setTransactionName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function ignoreTransaction(): void
    {
        $this->newRelic->ignoreTransaction();
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomEvent(string $name, array $attributes): void
    {
        $this->newRelic->addCustomEvent($name, $attributes);
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomMetric(string $name, float $value): bool
    {
        return $this->newRelic->addCustomMetric($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomParameter(string $name, $value): bool
    {
        return $this->newRelic->addCustomParameter($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBrowserTimingHeader(bool $includeTags = true): string
    {
        return $this->newRelic->getBrowserTimingHeader($includeTags);
    }

    /**
     * {@inheritDoc}
     */
    public function getBrowserTimingFooter(bool $includeTags = true): string
    {
        return $this->newRelic->getBrowserTimingFooter($includeTags);
    }

    /**
     * {@inheritDoc}
     */
    public function disableAutoRUM(): void
    {
        $this->newRelic->disableAutoRUM();
    }

    /**
     * {@inheritDoc}
     */
    public function noticeThrowable(Throwable $e, ?string $message = null): void
    {
        $this->newRelic->noticeThrowable($e, $message);
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
        $this->newRelic->noticeError($errNo, $errStr, $errFile, $errLine, $errContext);
    }

    /**
     * {@inheritDoc}
     */
    public function enableBackgroundJob(): void
    {
        $this->newRelic->enableBackgroundJob();
    }

    /**
     * {@inheritDoc}
     */
    public function disableBackgroundJob(): void
    {
        $this->newRelic->disableBackgroundJob();
    }

    /**
     * {@inheritDoc}
     */
    public function startTransaction(?string $name = null, ?string $license = null): bool
    {
        return $this->newRelic->startTransaction($name, $license);
    }

    /**
     * {@inheritDoc}
     */
    public function endTransaction(bool $ignore = false): bool
    {
        return $this->newRelic->endTransaction($ignore);
    }

    /**
     * {@inheritDoc}
     */
    public function excludeFromApdex(): void
    {
        $this->newRelic->excludeFromApdex();
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomTracer(string $name): bool
    {
        return $this->newRelic->addCustomTracer($name);
    }

    /**
     * {@inheritDoc}
     */
    public function setCaptureParams(bool $enabled): void
    {
        $this->newRelic->setCaptureParams($enabled);
    }

    /**
     * {@inheritDoc}
     */
    public function stopTransactionTiming(): void
    {
        $this->newRelic->stopTransactionTiming();
    }

    /**
     * {@inheritDoc}
     */
    public function recordDataStoreSegment(callable $func, array $parameters)
    {
        $this->newRelic->recordDatastoreSegment($func, $parameters);
    }

    /**
     * {@inheritDoc}
     */
    public function setUserAttributes(string $userValue, string $accountValue, string $productValue): bool
    {
        return $this->newRelic->setUserAttributes($userValue, $accountValue, $productValue);
    }
}
