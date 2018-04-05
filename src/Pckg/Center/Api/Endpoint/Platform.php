<?php namespace Pckg\Center\Api\Endpoint;

use Pckg\Api\Endpoint;

/**
 * Class Invoice
 *
 * @package Pckg\Pendo\Api\Endpoint
 */
class Platform extends Endpoint
{

    /**
     * @var string
     */
    protected $path = 'platform';

    /**
     * @param array $data
     *
     * @return Endpoint|$this
     */
    public function extendedCreate($data = [])
    {
        return $this->postAndDataResponse($data, $this->path . '/extended-create', $this->path);
    }

    /**
     * @param array $data
     *
     * @return Endpoint|$this
     */
    public function extendedConfirm($data = [])
    {
        return $this->postAndDataResponse($data, $this->path . '/extended-confirm', $this->path);
    }

    /**
     * @param $identifier
     *
     * @return $this
     */
    public function getStatus($identifier)
    {
        return $this->getAndDataResponse('platform/' . $identifier . '/status', 'platform');
    }

}