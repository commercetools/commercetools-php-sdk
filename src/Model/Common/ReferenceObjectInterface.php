<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 */

namespace Commercetools\Core\Model\Common;

interface ReferenceObjectInterface extends ContextAwareInterface
{
    /**
     * @return string
     */
    public function getReferenceIdentifier();

    /**
     * @return Reference
     */
    public function getReference();
}
