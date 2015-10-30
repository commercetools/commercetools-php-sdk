<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Request;

interface QueryAllRequestInterface extends
    PageRequestInterface,
    QueryRequestInterface,
    SortRequestInterface,
    WithTotalRequestInterface
{
}
