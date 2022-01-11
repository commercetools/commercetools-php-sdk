<?php
/**
 * @author @jenschude <jens.schulze@commercetools.de>
 * @created: 26.01.15, 15:19
 */

namespace Commercetools\Core\Model\Common;

use Commercetools\Core\Error\Message;
use Commercetools\Core\Error\InvalidArgumentException;

/**
 * @package Commercetools\Core\Model\Type
 * @link https://docs.commercetools.com/http-api-types.html#localizedstring
 * @example
 * ```php
 * LocalizedString::fromArray(['en' => 'Hello World', 'de' => 'Hallo Welt'])->add('fr', 'Bonjour le monde');
 * ```
 */
class LocalizedString implements \JsonSerializable, JsonDeserializeInterface
{
    use ContextTrait;

    /**
     * @var array
     */
    protected $values = [];

    /**
     * @param array $values
     * @param Context|callable $context
     */
    public function __construct(array $values, $context = null)
    {
        $this->setContext($context);
        foreach ($values as $locale => $value) {
            $this->add($locale, $value);
        }
    }

    /**
     * @param $locale
     * @return string
     */
    public function __get($locale)
    {
        $context = new Context();
        $context->setLanguages([$locale])->setGraceful($this->getContext()->isGraceful());
        return $this->get($context);
    }

    /**
     * @param Context $context
     * @return string
     */
    public function getLocalized(Context $context = null)
    {
        return $this->get($context);
    }
    /**
     * @param Context $context
     * @return string
     */
    protected function getLanguage(Context $context)
    {
        $locale = null;
        foreach ($context->getLanguages() as $locale) {
            $locale = \Locale::canonicalize($locale);
            if (isset($this->values[$locale])) {
                return $locale;
            }
            $language = \Locale::getPrimaryLanguage($locale);
            if ($locale == $language) {
                continue;
            }
            if (isset($this->values[$language])) {
                return $language;
            }
        }
        return $locale;
    }

    /**
     * @param Context $context
     * @return string
     */
    public function get(Context $context = null)
    {
        if (is_null($context)) {
            $context = $this->getContext();
        }
        $locale = $this->getLanguage($context);
        if (!isset($this->values[$locale])) {
            if (!$context->isGraceful()) {
                throw new InvalidArgumentException(Message::NO_VALUE_FOR_LOCALE);
            }
            return '';
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
        $locale = \Locale::canonicalize($locale);
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
        $values = $this->values;

        $data = [];
        foreach ($values as $key => $value) {
            $data[str_replace('_', '-', $key)] = $value;
        }
        return $data;
    }

    #[\ReturnTypeWillChange]
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @param Context|callable $context
     * @return $this
     */
    public static function of($context = null)
    {
        return new static([], $context);
    }

    /**
     * @param array $data
     * @param Context|callable $context
     * @return static
     */
    public static function fromArray(array $data, $context = null)
    {
        return new static($data, $context);
    }

    /**
     * @param string $language
     * @param string $text
     * @param Context|callable $context
     * @return LocalizedString
     */
    public static function ofLangAndText($language, $text, $context = null)
    {
        return new static([$language => $text], $context);
    }
}
