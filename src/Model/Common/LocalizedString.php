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
    use ContextTrait;

    /**
     * @var array
     */
    protected $values = [];

    /**
     * @param array $values
     * @param Context $context
     */
    public function __construct(array $values, Context $context = null)
    {
        $this->setContext($context);
        $this->values = $values;
    }

    /**
     * @param $locale
     * @return string
     */
    public function __get($locale)
    {
        $context = new Context();
        $context->setLanguages([$locale]);
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
        foreach ($context->getLanguages() as $language) {
            if (isset($this->values[$language])) {
                $locale = $language;
                break;
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
     * @param Context $context
     * @return static
     */
    public static function fromArray(array $data, Context $context = null)
    {
        return new static($data, $context);
    }
}
