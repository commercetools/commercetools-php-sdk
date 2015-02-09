<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:19
 */

namespace Sphere\Core\Model\Common;

use Sphere\Core\Error\Message;
use Sphere\Core\Error\InvalidArgumentException;

/**
 * Class LocalizedString
 * @package Sphere\Core\Model\Type
 * @example LocalizedString::of(['en' => 'Hello World', 'de' => 'Hallo Welt'])->add('fr', 'Bonjour le monde');
 */
class LocalizedString implements \JsonSerializable, JsonDeserializeInterface
{
    protected static $language;
    protected $values = [];

    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @param $language
     * @internal
     */
    public static function setDefaultLanguage($language)
    {
        static::$language = $language;
    }

    /**
     * @return string
     */
    protected function getDefaultLanguage()
    {
        if (is_null(static::$language)) {
            if (extension_loaded('intl')) {
                $locale = \Locale::getDefault();
                static::setDefaultLanguage(\Locale::getPrimaryLanguage($locale));
            }
        }
        return static::$language;
    }

    /**
     * @param $locale
     * @return string
     */
    public function get($locale = null)
    {
        if (is_null($locale)) {
            $locale = $this->getDefaultLanguage();
        }
        if (!isset($this->values[$locale])) {
            throw new InvalidArgumentException(Message::NO_VALUE_FOR_LOCALE);
        }
        return $this->values[$locale];
    }

    /**
     * @param string $locale
     * @param string $value
     * @return $this
     */
    public function add($locale, $value)
    {
        $this->values[$locale] = $value;

        return $this;
    }

    public function merge(LocalizedString $localizedString)
    {
        $this->values = array_merge($this->values, $localizedString->toArray());
    }

    public function __toString()
    {
        return $this->get();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->values;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @param array $values
     * @return $this
     */
    public static function of(array $values)
    {
        return new static($values);
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data)
    {
        return new static($data);
    }
}
