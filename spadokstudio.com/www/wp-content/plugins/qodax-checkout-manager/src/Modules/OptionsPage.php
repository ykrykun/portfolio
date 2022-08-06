<?php

namespace Qodax\CheckoutManager\Modules;

use Qodax\CheckoutManager\Foundation\Routing\Route;
use Qodax\CheckoutManager\Foundation\View;
use Qodax\CheckoutManager\Http\Controllers\FieldsController;
use Qodax\CheckoutManager\Http\Controllers\SettingsController;

if ( ! defined('ABSPATH')) {
    exit;
}

class OptionsPage extends AbstractModule
{
    public function boot(): void
    {
        $this->initRoutes();
        add_action('admin_menu', [ $this, 'registerOptionsPage' ], 99);
    }

    public function registerOptionsPage()
    {
        add_submenu_page(
            'woocommerce',
            'Qodax Checkout Manager',
            'Qodax Checkout Manager',
            'manage_options',
            'qodax_checkout_manager',
            [ $this, 'html' ]
        );
    }

    public function html()
    {
        echo View::render('checkout_manager');
    }

    private function initRoutes()
    {
        $this->router->addRoute(Route::make('qodax_checkout_manager_fields', FieldsController::class, 'getFields'));
        $this->router->addRoute(Route::make('qodax_checkout_manager_save_fields', FieldsController::class, 'save'));
        $this->router->addRoute(Route::make('qodax_checkout_manager_restore_defaults', FieldsController::class, 'restoreDefaults'));
        $this->router->addRoute(Route::make('qodax_checkout_manager_get_settings', SettingsController::class, 'getSettings'));
        $this->router->addRoute(Route::make('qodax_checkout_manager_save_settings', SettingsController::class, 'save'));
    }
}