<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


use Pimple\Container;
use Psr\Log\LoggerInterface;
use Sphere\Core\Helper\CurrencyFormatter;

class Context extends Container
{
    const GRACEFUL = 'graceful';
    const LANGUAGES = 'languages';
    const CURRENCY_FORMATTER = 'currencyFormatter';
    const LOCALE = 'locale';
    const LOGGER = 'logger';

    public function __construct()
    {
        parent::__construct();

        $context = $this;
        $this[static::GRACEFUL] = false;
        $this[static::LANGUAGES] = [];
        $this[static::CURRENCY_FORMATTER] = function () use ($context) {
            return new CurrencyFormatter($context);
        };
        $this[static::LOCALE] = null;
        if (extension_loaded('intl')) {
            $this[static::LOCALE] = \Locale::getDefault();
        }
        $this[static::LOGGER] = null;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this[static::LOCALE];
    }

    /**
     * @param $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this[static::LOCALE] = $locale;

        return $this;
    }

    /**
     * @return CurrencyFormatter
     */
    public function getCurrencyFormatter()
    {
        return $this[static::CURRENCY_FORMATTER];
    }

    /**
     * @param CurrencyFormatter $currencyFormatter
     * @return $this
     */
    public function setCurrencyFormatter(CurrencyFormatter $currencyFormatter)
    {
        $this[static::CURRENCY_FORMATTER] = $currencyFormatter;

        return $this;
    }

    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this[static::LANGUAGES];
    }

    /**
     * @param array $languages
     * @return $this
     */
    public function setLanguages(array $languages)
    {
        $this[static::LANGUAGES] = $languages;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isGraceful()
    {
        return $this[static::GRACEFUL];
    }

    /**
     * @param $graceful
     * @return $this
     */
    public function setGraceful($graceful)
    {
        $this[static::GRACEFUL] = $graceful;

        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this[static::LOGGER];
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this[static::LOGGER] = $logger;

        return $this;
    }

    public static function of()
    {
        return new static();
    }
}
