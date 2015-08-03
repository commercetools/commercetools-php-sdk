<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

/**
 * @package Commercetools\Core\Model\Common
 */
class DateTimeDecorator implements \JsonSerializable
{
    /**
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * @param \DateTime|string $dateTime
     */
    public function __construct($dateTime = null)
    {
        if (is_string($dateTime)) {
            $dateTime = new \DateTime($dateTime);
        }
        $this->setDateTime($dateTime);
    }

    /**
     * @return \DateTime
     */
    public function getDateTime()
    {
        if (is_null($this->dateTime)) {
            $this->dateTime = new \DateTime();
        }
        return $this->dateTime;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime(\DateTime $dateTime = null)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return \DateTime
     */
    public function getUtcDateTime()
    {
        $dateTime = clone $this->getDateTime();
        $dateTime->setTimezone(new \DateTimeZone('UTC'));

        return $dateTime;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->getUtcDateTime()->format('c');
    }

    /**
     * @param string $format
     * @return string
     */
    public function format($format)
    {
        return $this->getDateTime()->format($format);
    }
}
