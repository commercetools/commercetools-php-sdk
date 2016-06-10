<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:07
 */

namespace Commercetools\Core\Client;

use Psr\Http\Message\UploadedFileInterface;

/**
 * @package Commercetools\Core\Http
 * @internal
 */
class FileUploadRequest extends HttpRequest
{
    public function __construct($path, UploadedFileInterface $file)
    {
        parent::__construct('POST', $path, $file->getStream(), $file->getClientMediaType());
    }
}
