<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Request\CustomObjects;


use Sphere\Core\Model\Common\Context;
use Sphere\Core\Model\CustomObject\CustomObject;
use Sphere\Core\Request\AbstractCreateRequest;

class CustomObjectCreateRequest extends AbstractCreateRequest
{
    protected $resultClass = '\Sphere\Core\Model\CustomObject\CustomObject';

    /**
     * @param CustomObject $customObject
     * @param Context $context
     */
    public function __construct(CustomObject $customObject, Context $context = null)
    {
        parent::__construct(CustomObjectsEndpoint::endpoint(), $customObject, $context);
    }
}
