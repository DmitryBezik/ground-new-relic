<?php

declare(strict_types=1);

namespace Ground\NewRelic;

use Throwable;

interface NewRelicInterface
{
    /**
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_set_appname}
     *
     * @param string $name
     * @param string|null $license
     * @param bool $xmit
     * @return bool
     */
    public function setApplicationName(string $name, ?string $license = null, bool $xmit = false): bool;

    /**
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_name_transaction}
     *
     * @param string $name
     * @return bool
     */
    public function setTransactionName(string $name): bool;

    /**
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_ignore_transaction}
     */
    public function ignoreTransaction(): void;

    /**
     * Records a custom event for use in New Relic Insights
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_record_custom_event}
     *
     * @param string $name
     * @param mixed[] $attributes
     */
    public function addCustomEvent(string $name, array $attributes): void;

    /**
     * Add a custom metric (in milliseconds) to time a component of your app not captured by defaultrecordDataStoreSegment
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newreliccustommetric-php-agent-api}
     *
     * @param string $name
     * @param float $value
     * @return bool
     */
    public function addCustomMetric(string $name, float $value): bool;

    /**
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_add_custom_parameter}
     *
     * @param string $name
     * @param string|int|float $value should be a scalar
     * @return bool
     */
    public function addCustomParameter(string $name, $value): bool;

    /**
     * Disable automatic injection of the New Relic Browser snippet on particular pages.
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_disable_autorum}
     */
    public function disableAutoRUM(): void;

    /**
     * Use these calls to collect errors that the PHP agent does not collect automatically and to set the callback for
     * your own error and exception handler
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_notice_error}
     *
     * @param Throwable $e
     * @param string|null $message
     */
    public function noticeThrowable(Throwable $e, ?string $message = null): void;

    /**
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_notice_error}
     *
     * @param int $errNo
     * @param string $errStr
     * @param string|null $errFile
     * @param int|null $errLine
     * @param string|null $errContext
     */
    public function noticeError(int $errNo, string $errStr, ?string $errFile = null, ?int $errLine = null, ?string $errContext = null): void;

    /**
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_background_job}
     */
    public function enableBackgroundJob(): void;

    /**
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_background_job}
     */
    public function disableBackgroundJob(): void;

    /**
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_start_transaction}
     *
     * @param string|null $name
     * @param string|null $license
     * @return bool
     */
    public function startTransaction(?string $name = null, ?string $license = null): bool;

    /**
     * Stop instrumenting the current transaction immediately, and send the data to the daemon.
     * This call simulates what the agent normally does when PHP terminates the current transaction.
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_end_transaction}
     *
     * @param bool $ignore
     * @return bool
     */
    public function endTransaction(bool $ignore = false): bool;

    /**
     * Ignore the current transaction when calculating Apdex
     *
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_ignore_apdex}
     */
    public function excludeFromApdex(): void;

    /**
     * Specify functions or methods for the agent to target for custom instrumentation. This is the API equivalent of
     * the newrelic.transaction_tracer.custom setting
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_add_custom_tracer}
     *
     * @param string $name
     * @return bool
     */
    public function addCustomTracer(string $name): bool;

    /**
     * Enable or disable the capture of URL parameters
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_capture_params}
     *
     * @param bool $enabled
     */
    public function setCaptureParams(bool $enabled): void;

    /**
     * Stop timing the current transaction, but continue instrumenting it
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_end_of_transaction}
     */
    public function stopTransactionTiming(): void;

    /**
     * {@link https://docs.newrelic.com/docs/agents/php-agent/php-agent-api/newrelic_record_datastore_segment}
     *
     * @param callable $func
     * @param string[] $parameters
     * @return mixed
     */
    public function recordDataStoreSegment(callable $func, array $parameters);
}
