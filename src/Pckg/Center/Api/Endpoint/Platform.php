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

    /**
     * @param $identifier
     *
     * @return $this
     */
    public function getConfig($identifier)
    {
        return $this->getAndDataResponse('platform/' . $identifier . '/config', 'config');
    }

    /**
     * @param $identifier
     * @param $domains
     *
     * @return Platform
     */
    public function postDomains($identifier, $domains)
    {
        return $this->postAndDataResponse($domains, 'platform/' . $identifier . '/domains', 'platform');
    }

    /**
     * @param $identifier
     * @param $app
     *
     * @return Platform
     */
    public function postApp($identifier, $app)
    {
        return $this->postAndDataResponse(['app' => $app], 'platform/' . $identifier . '/app', 'platform');
    }

    /**
     * @param $script
     *
     * @return Platform
     */
    public function runScript($script)
    {
        return $this->postAndDataResponse(['script' => $script], 'platform/' . $identifier . '/script', 'platform');
    }

}