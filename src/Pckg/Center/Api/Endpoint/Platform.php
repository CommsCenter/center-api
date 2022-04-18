<?php

namespace Pckg\Center\Api\Endpoint;

use Pckg\Api\Endpoint;
use Pckg\Collection;

/**
 * Class Invoice
 *
 * @package Pckg\Pendo\Api\Endpoint
 * @property int $id
 * @property string $name
 * @property string $domain
 * @property string $domains
 * @property string $identifier
 * @property string $branch
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
     * @return $this
     */
    public function getStatus($identifier)
    {
        return $this->getAndDataResponse('platform/' . $identifier . '/status', 'platform');
    }

    /**
     * @return $this
     */
    public function getConfig($identifier)
    {
        return $this->getAndDataResponse('platform/' . $identifier . '/config', 'config');
    }

    /**
     * @return Platform
     */
    public function postDomains(string $identifier, $domains)
    {
        return $this->postAndDataResponse($domains, 'platform/' . $identifier . '/domains', 'platform');
    }

    /**
     * @return ?string
     */
    public function getChannel()
    {
        return $this->getAndDataResponse('platform/' . $this->id . '/channel', 'platform')->channel;
    }

    /**
     * @return ?bool
     */
    public function softDeepDelete()
    {
        return $this->getAndDataResponse('platform/' . $this->identifier . '/soft-deep-delete', 'success');
    }

    /**
     * @return Platform
     */
    public function postChannel(int $id, array $data)
    {
        return $this->postAndDataResponse($data, 'platform/' . $id . '/channel', 'platform');
    }

    /**
     * @return Platform
     */
    public function postApp($identifier, $app)
    {
        return $this->postAndDataResponse(['app' => $app], 'platform/' . $identifier . '/app', 'platform');
    }

    /**
     * @return Platform
     */
    public function runScript($identifier, $script)
    {
        return $this->postAndDataResponse(['script' => $script], 'platform/' . $identifier . '/script', 'platform');
    }

    public function getStats()
    {
        $this->getApi()->getApi('platform/' . $this->id . '/stats');

        return $this->getApi()->getApiResponse('stats');
    }

    /**
     * @return array|mixed|null
     */
    public function isCommsShopDomainFree(string $identifier, $domain)
    {
        return $this->postAndDataResponse(['domain' => $domain], 'platform/' . $identifier . '/comms-shop/validate', 'domain')
            ->data();
    }

    /**
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

    public function makeBackup($id)
    {
        $api = $this->getApi();
        $this->postAndDataResponse([], 'platform/' . $id . '/backup/create');

        return $api->getApiResponse();
    }

    public function restoreBackup($id)
    {
        $api = $this->getApi();
        $this->postAndDataResponse([], 'platform/' . $id . '/backup/restore');

        return $api->getApiResponse();
    }
}
