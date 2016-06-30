<?php
/**
 * @author @jayS-de <jens.schulze@commercetools.de>
 * @created: 23.01.15, 16:07
 */

namespace Commercetools\Core\Client;

/**
 * @package Commercetools\Core\Http
 * @internal
 * @deprecated replaced by FileUploadRequest. will be removed with v2.0
 */
class FileRequest extends HttpRequest
{
    protected $file;

    public function __construct($method, $path, $file, $contentType)
    {
        $this->setFile($file);
        parent::__construct($method, $path, null, $contentType);
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    protected function setFile($file)
    {
        $this->file = $file;
    }
}
