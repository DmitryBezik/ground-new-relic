<?php

declare(strict_types=1);

namespace Ground\NewRelic;

use Throwable;

use function ini_get;
use function newrelic_add_custom_parameter;
use function newrelic_add_custom_tracer;
use function newrelic_background_job;
use function newrelic_capture_params;
use function newrelic_custom_metric;
use function newrelic_disable_autorum;
use function newrelic_end_transaction;
use function newrelic_ignore_apdex;
use function newrelic_ignore_transaction;
use function newrelic_name_transaction;
use function newrelic_notice_error;
use function newrelic_record_custom_event;
use function newrelic_record_datastore_segment;
use function newrelic_set_appname;

final class NewRelic implements NewRelicInterface
{
    /**
     * {@inheritDoc}
     */
    public function setApplicationName(string $name, ?string $license = null, bool $xmit = false): bool
    {
        return newrelic_set_appname($name, $license, $xmit);
    }

    /**
     * {@inheritDoc}
     */
    public function setTransactionName(string $name): bool
    {
        return newrelic_name_transaction($name);
    }

    /**
     * {@inheritDoc}
     */
    public function ignoreTransaction(): void
    {
        newrelic_ignore_transaction();
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomEvent(string $name, array $attributes): void
    {
        newrelic_record_custom_event($name, $attributes);
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomMetric(string $name, float $value): bool
    {
        return newrelic_custom_metric($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomParameter(string $name, $value): bool
    {
        return newrelic_add_custom_parameter($name, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function disableAutoRUM(): void
    {
        newrelic_disable_autorum();
    }

    /**
     * {@inheritDoc}
     */
    public function noticeError(int $errNo, string $errStr, ?string $errFile = null, ?int $errLine = null, ?string $errContext = null): void
    {
        newrelic_notice_error($errNo, $errStr, $errFile, $errLine, $errContext);
    }

    /**
     * {@inheritDoc}
     */
    public function noticeThrowable(Throwable $e, ?string $message = null): void
    {
        newrelic_notice_error($message ?: $e->getMessage(), $e);
    }

    /**
     * {@inheritDoc}
     */
    public function enableBackgroundJob(): void
    {
        newrelic_background_job(true);
    }

    /**
     * {@inheritDoc}
     */
    public function disableBackgroundJob(): void
    {
        newrelic_background_job(false);
    }

    /**
     * {@inheritDoc}
     */
    public function endTransaction(bool $ignore = false): bool
    {
        return newrelic_end_transaction($ignore);
    }

    /**
     * {@inheritDoc}
     */
    public function startTransaction(?string $name = null, ?string $license = null): bool
    {
        if (null === $name) {
            $name = ini_get('newrelic.appname');
        }

        if (null === $license) {
            return newrelic_start_transaction($name);
        }

        return newrelic_start_transaction($name, $license);
    }

    /**
     * {@inheritDoc}
     */
    public function excludeFromApdex(): void
    {
        newrelic_ignore_apdex();
    }

    /**
     * {@inheritDoc}
     */
    public function addCustomTracer(string $name): bool
    {
        return newrelic_add_custom_tracer($name);
    }

    /**
     * {@inheritDoc}
     */
    public function setCaptureParams(bool $enabled): void
    {
        newrelic_capture_params($enabled);
    }

    /**
     * {@inheritDoc}
     */
    public function stopTransactionTiming(): void
    {
        newrelic_end_of_transaction();
    }

    /**
     * {@inheritDoc}
     */
    public function recordDataStoreSegment(callable $func, array $parameters)
    {
        return newrelic_record_datastore_segment($func, $parameters);
    }
}
