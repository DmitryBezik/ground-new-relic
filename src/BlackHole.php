<?php

declare(strict_types=1);

namespace Ground\NewRelic;

use Throwable;

final class BlackHole implements NewRelicInterface
{
    /**
     * {@inheritDoc}
     */
    public function setApplicationName(string $name, ?string $license = null, bool $xmit = false): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function setTransactionName(string $name): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function ignoreTransaction(): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomEvent(string $name, array $attributes): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomMetric(string $name, float $value): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomParameter(string $name, $value): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getBrowserTimingHeader(bool $includeTags = true): string
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function getBrowserTimingFooter(bool $includeTags = true): string
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function disableAutoRUM(): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function noticeThrowable(Throwable $e, ?string $message = null): void
    {
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
    }

    /**
     * {@inheritDoc}
     */
    public function enableBackgroundJob(): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function disableBackgroundJob(): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function startTransaction(?string $name = null, ?string $license = null): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function endTransaction(bool $ignore = false): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function excludeFromApdex(): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomTracer(string $name): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function setCaptureParams(bool $enabled): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function stopTransactionTiming(): void
    {
    }

    /**
     * {@inheritDoc}
     */
    public function recordDataStoreSegment(callable $func, array $parameters)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function setUserAttributes(string $userValue, string $accountValue, string $productValue): bool
    {
        return true;
    }
}
