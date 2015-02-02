<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:36
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Model\OfTrait;
use Sphere\Core\Request\AbstractFetchByIdRequest;
use Sphere\Core\Request\StagedTrait;

class ProductProjectionFetchByIdRequest extends AbstractFetchByIdRequest
{
    use OfTrait;
    use StagedTrait;

    /**
     * @param int $id
     * @param bool $staged
     */
    public function __construct($id, $staged = false)
    {
        parent::__construct(ProductProjectionEndpoint::endpoint(), $id);
        $this->staged($staged);
    }

    /**
     * @return string
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getId() . $this->getParamString();
    }
}
