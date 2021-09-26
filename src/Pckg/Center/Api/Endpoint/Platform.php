<?php namespace Pckg\Center\Api\Endpoint;

use Pckg\Api\Endpoint;
use Pckg\Collection;

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
    public function runScript($identifier, $script)
    {
        return $this->postAndDataResponse(['script' => $script], 'platform/' . $identifier . '/script', 'platform');
    }

    /**
     * @param $identifier
     * @param $domain
     * @return array|mixed|null
     */
    public function isCommsShopDomainFree(string $identifier, $domain)
    {
        return $this->postAndDataResponse(['domain' => $domain], 'platform/' . $identifier . '/comms-shop/validate', 'domain')
            ->data();
    }

    /**
     * @param $identifier
     * @param $domain
     * @return array|mixed|null
     */
    public function registerCommsShopDomain(string $identifier, $domain)
    {
        return $this->postAndDataResponse([
            'domain' => $domain,
            '_webhook' => [
                'domain:registered' => 'https://' . $identifier . '.id.startcomms.com/api/webhook/comms-shop/registered'
            ],
        ], 'platform/' . $identifier . '/comms-shop/register', 'domain')
            ->data();
    }

    public function getCommsStores(): Collection
    {
        $api = $this->getApi();
        $this->getAndDataResponse('platform');

        return collect($api->getApiResponse('platforms'))->map(fn($data) => new Platform($api, $data));
    }

    public function makeBackup($id, array $hook = [])
    {
        $api = $this->getApi();
        $this->postAndDataResponse([
            'hooks' => $hooks,
        ], 'platform/' . $id . '/backup');

        return $api->getApiResponse('backup');
    }
}
