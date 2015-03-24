<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class DateTime
 * @package Sphere\Core\Model\Common
 */
class DateTimeDecorator implements \JsonSerializable
{
    /**
     * @var \DateTime
     */
    protected $dateTime;

    /**
     * @param \DateTime $dateTime
     */
    public function __construct(\DateTime $dateTime = null)
    {
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
    public function setDateTime($dateTime)
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

    public function jsonSerialize()
    {
        return $this->getUtcDateTime()->format('c');
    }
}
