<?php
/**
 * @author @ct-jensschulze <jens.schulze@commercetools.de>
 * @created: 26.01.15, 14:44
 */

namespace Sphere\Core\Response;


use GuzzleHttp\Message\ResponseInterface;

class ApiResponse
{
    /**
     * @var ResponseInterface
     */
    protected $result;

    public function __construct(ResponseInterface $result)
    {
        $this->result = $result;
    }

    public function json()
    {
        return $this->result->json();
    }

    public function getResult()
    {
        return $this->result;
    }
}
