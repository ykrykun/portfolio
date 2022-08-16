<?php

namespace kirillbdev\WCUkrShipping\Http\Controllers;

use kirillbdev\WCUkrShipping\DB\Repositories\WarehouseSyncRepository;
use kirillbdev\WCUkrShipping\Exceptions\ApiErrorException;
use kirillbdev\WCUkrShipping\Exceptions\ApiServiceException;
use kirillbdev\WCUkrShipping\Exceptions\NovaPoshtaAddressProviderException;
use kirillbdev\WCUkrShipping\Services\Address\AddressBookService;
use kirillbdev\WCUSCore\Http\Controller;
use kirillbdev\WCUSCore\Http\Request;

if ( ! defined('ABSPATH')) {
    exit;
}

class AddressBookController extends Controller
{
    /**
     * @var AddressBookService
     */
    private $addressBookService;

    /**
     * @var WarehouseSyncRepository
     */
    private $syncRepository;

    public function __construct(AddressBookService $addressBookService, WarehouseSyncRepository $syncRepository)
    {
        $this->addressBookService = $addressBookService;
        $this->syncRepository = $syncRepository;
    }

    public function loadAreas(Request $request)
    {
        try {
            $this->addressBookService->loadAreas();

            return $this->jsonResponse([
                'success' => true
            ]);
        }
        catch (NovaPoshtaAddressProviderException $e) {
            return $this->jsonResponse($this->processException($e));
        }
    }

    public function loadCities(Request $request)
    {
        try {
            $count = $this->addressBookService->loadCities((int)$request->get('page'));

            return $this->jsonResponse([
                'success' => true,
                'data' => [
                    'loaded' => $count === 0
                ]
            ]);
        }
        catch (NovaPoshtaAddressProviderException $e) {
            return $this->jsonResponse($this->processException($e));
        }
    }

    public function loadWarehouses(Request $request)
    {
        try {
            $count = $this->addressBookService->loadWarehouses((int)$request->get('page'));

            return $this->jsonResponse([
                'success' => true,
                'data' => [
                    'loaded' => $count === 0,
                    'last_sync' => $count === 0 ? $this->syncRepository->getLastSync() : null
                ]
            ]);
        }
        catch (NovaPoshtaAddressProviderException $e) {
            return $this->jsonResponse($this->processException($e));
        }
    }

    private function processException(\Exception $e): array
    {
        return [
            'success' => false,
            'last_sync' => $this->syncRepository->getLastSync(),
            'errors' => [
                $e->getMessage()
            ]
        ];
    }
}