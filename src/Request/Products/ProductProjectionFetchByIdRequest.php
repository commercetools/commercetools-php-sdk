<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 02.02.15, 17:36
 */

namespace Sphere\Core\Request\Products;


use Sphere\Core\Request\AbstractFetchByIdRequest;
use Sphere\Core\Request\Endpoints\ProductProjectionsEndpoint;
use Sphere\Core\Request\StagedTrait;

class ProductProjectionFetchByIdRequest extends AbstractFetchByIdRequest
{
    use StagedTrait;

    /**
     * @param int $id
     */
    public function __construct($id)
    {
        parent::__construct(ProductProjectionsEndpoint::endpoint(), $id);
    }

    /**
     * @return string
     * @internal
     */
    protected function getPath()
    {
        return (string)$this->getEndpoint() . '/' . $this->getId() . $this->getParamString();
    }
}
