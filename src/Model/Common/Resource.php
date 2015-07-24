<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;

/**
 * Class Resource
 * @package Sphere\Core\Model\Common
 * @method getId()
 */
abstract class Resource extends JsonObject implements ReferenceObjectInterface
{
    public function getReferenceIdentifier()
    {
        return $this->getId();
    }

    /**
     * @return Reference
     */
    public function getReference()
    {
        $className = trim(get_called_class(), '\\');
        $referenceClass = $className . 'Reference';
        if (class_exists($referenceClass)) {
            $reference = call_user_func_array(
                $referenceClass . '::ofId',
                [$this->getReferenceIdentifier(), $this->getContextCallback()]
            );
        } else {
            $classParts = explode('\\', $className);
            $class = lcfirst(array_pop($classParts));
            $type = strtolower(preg_replace('/([A-Z])/', '-$1', $class));

            $reference = Reference::ofTypeAndId($type, $this->getReferenceIdentifier(), $this->getContextCallback());
        }
        $reference->setObj($this);

        return $reference;
    }
}
