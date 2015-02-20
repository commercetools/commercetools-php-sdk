<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Sphere\Core\Model\Common;


interface ContextAwareInterface
{
    /**
     * @return Context
     */
    public function getContext();

    /**
     * @param Context $context
     * @return mixed
     */
    public function setContext(Context $context);
}
