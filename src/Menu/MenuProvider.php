<?php

namespace AvoRed\Framework\Menu;

use AvoRed\Framework\Menu\MenuItem;
use AvoRed\Framework\Menu\MenuBuilder;
use Illuminate\Support\ServiceProvider;

class MenuProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the Service Provider.
     * @return void
     */
    public function boot()
    {
        $this->registerAdminMenu();
    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->app->alias('menu', MenuBuilder::class);
    }

    /**
     * Register the Admin Menu instance.
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton(
            'menu',
            function () {
                return new MenuBuilder();
            }
        );
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return ['menu', MenuBuilder::class];
    }

    /**
     * Register Admin Menu for the AvoRed E commerce package.
     * @return void
     */
    public function registerAdminMenu()
    {
        Menu::make('catalog', function (MenuItem $menu) {
            $menu->label('avored::system.catalog')
                ->type(MenuItem::ADMIN)
                // ->icon('shopping-bag')
                ->route('#');
        });

        $catalogMenu = Menu::get('catalog');

        /** @var Builder $catalogMenu */
        $catalogMenu->subMenu('product', function (MenuItem $menu) {
            $menu->key('product')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.product')
                ->route('admin.product.index');
        });
        $catalogMenu->subMenu('category', function (MenuItem $menu) {
            $menu->key('category')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.category')
                ->route('admin.category.index');
        });
        $catalogMenu->subMenu('property', function (MenuItem $menu) {
            $menu->key('property')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.property')
                ->route('admin.property.index');
        });

        $catalogMenu->subMenu('attribute', function (MenuItem $menu) {
            $menu->key('attribute')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.attribute')
                ->route('admin.attribute.index');
        });

        // Menu::make('cms', function (MenuItem $menu) {
        //     $menu->label('avored::system.cms')
        //         ->type(MenuItem::ADMIN)
        //         ->icon('book-open')
        //         ->route('#');
        // });
        /** @var Builder $cmsMenu */
        $cmsMenu = Menu::get('cms');
        // $cmsMenu->subMenu('menu-group', function (MenuItem $menu) {
        //     $menu->key('menu-group')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.menu')
        //         ->route('admin.menu-group.index');
        // });
        // $cmsMenu->subMenu('page', function (MenuItem $menu) {
        //     $menu->key('page')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.page')
        //         ->route('admin.page.index');
        // });
        Menu::make('order', function (MenuItem $menu) {
            $menu->label('avored::system.order')
                // ->icon('dollar-sign')
                ->type(MenuItem::ADMIN)
                ->route('#');
        });
        /** @var Builder $orderMenu */
        $orderMenu = Menu::get('order');

        $orderMenu->subMenu('order', function (MenuItem $menu) {
            $menu->key('order')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.order')
                ->route('admin.order.index');
        });
        $orderMenu->subMenu('order-status', function (MenuItem $menu) {
            $menu->key('order-status')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.order-status')
                ->route('admin.order-status.index');
        });

        Menu::make('post', function (MenuItem $menu) {
            $menu->label('Post')
                // ->icon('dollar-sign')
                ->type(MenuItem::ADMIN)
                ->route('#');
        });
        /** @var Builder $postMenu */
        $postMenu = Menu::get('post');

        $postMenu->subMenu('post', function (MenuItem $menu) {
            $menu->key('post')
                ->type(MenuItem::ADMIN)
                ->label('Post List')
                ->route('admin.post.index');
        });

        Menu::make('recipe', function (MenuItem $menu) {
            $menu->key('recipe')->label('Recipe')->type(MenuItem::ADMIN)->route('#');
        });
        $recipeMenu = Menu::get('recipe');
        $recipeMenu->subMenu('recipes_list', function (MenuItem $menu) {
            $menu->key('recipes_list')
                ->type(MenuItem::ADMIN)
                ->label('Recipes List')
                ->route('admin.recipe.index');
        });

        Menu::make('category', function (MenuItem $menu) {
            $menu->key('category')->label('Marketplace Categories')->type(MenuItem::ADMIN)->route('#');
        });
        $recipeMenu = Menu::get('category');
        $recipeMenu->subMenu('category_list', function (MenuItem $menu) {
            $menu->key('category_list')
                ->type(MenuItem::ADMIN)
                ->label('Marketplace Categories List')
                ->route('admin.new_category.index');
        });

        Menu::make('product', function (MenuItem $menu) {
            $menu->key('product')->label('Marketplace Products')->type(MenuItem::ADMIN)->route('#');
        });
        $recipeMenu = Menu::get('product');
        $recipeMenu->subMenu('product_list', function (MenuItem $menu) {
            $menu->key('product_list')
                ->type(MenuItem::ADMIN)
                ->label('Marketplace Products List')
                ->route('admin.new_product.index');
        });

        Menu::make('equipment', function (MenuItem $menu) {
            $menu->key('equipment')->label('Equipment')->type(MenuItem::ADMIN)->route('#');
        });
        $recipeMenu = Menu::get('equipment');
        $recipeMenu->subMenu('equipment_list', function (MenuItem $menu) {
            $menu->key('equipment_list')
                ->type(MenuItem::ADMIN)
                ->label('Equipment List')
                ->route('admin.equipment.index');
        });

        // Menu::make('report', function (MenuItem $menu) {
        //     $menu->label('avored::system.admin_menus.report')
        //         ->type(MenuItem::ADMIN)
        //         ->icon('book-reference')
        //         ->route('#');
        // });
        // $reportMenu = Menu::get('report');
        // $reportMenu->subMenu('new_customer', function (MenuItem $menu) {
        //     $menu->key('new_customer')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.admin_menus.new_customer')
        //         ->route('admin.report.index')
        //         ->params(['identifier' => 'new-customer']);
        // });

        // Menu::make('promotion', function (MenuItem $menu) {
        //     $menu->label('avored::system.admin_menus.promotion')
        //         ->icon('ticket')
        //         ->type(MenuItem::ADMIN)
        //         ->route('#');
        // });
        // $promotionMenu = Menu::get('promotion');
        // /** @var Builder $promotionMenu */
        // $promotionMenu->subMenu('promotion_code', function (MenuItem $menu) {
        //     $menu->key('promotion_code')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.admin_menus.promo-code')
        //         ->route('admin.promotion-code.index');
        // });

        Menu::make('user', function (MenuItem $menu) {
            $menu->label('avored::system.user')
                ->type(MenuItem::ADMIN)
//                ->icon('users')
                ->route('#');
        });
        /** @var $userMenu \AvoRed\Framework\Menu\MenuBuilder */
        $userMenu = Menu::get('user');

        // $userMenu->subMenu('customer_group', function (MenuItem $menu) {
        //     $menu->key('customer_group')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.admin_menus.customer-group')
        //         ->route('admin.customer-group.index');
        // });

        $userMenu->subMenu('staff', function (MenuItem $menu) {
            $menu->key('staff')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.staff')
                ->route('admin.staff.index');
        });

        $userMenu->subMenu('users_list', function (MenuItem $menu) {
            $menu->key('users_list')
                ->type(MenuItem::ADMIN)
                ->label('Users List')
                ->route('admin.users.index');
        });
        // $userMenu->subMenu('subscriber', function (MenuItem $menu) {
        //     $menu->key('subscriber')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.subscriber')
        //         ->route('admin.subscriber.index');
        // });

        Menu::make('group_chat', function (MenuItem $menu) {
            $menu->label('Group Chat')
                ->type(MenuItem::ADMIN)
//                ->icon('users')
                ->route('#');
        });
        $groupChatMenu = Menu::get('group_chat');
        $groupChatMenu->subMenu('group_list', function (MenuItem $menu) {
            $menu->key('group_list')
                ->type(MenuItem::ADMIN)
                ->label("List")
                ->route('admin.group-chat.index');
        });

        /** Map Data menu **/
        Menu::make('map_data', function (MenuItem $menu) {
            $menu->label('Map Data')
                ->type(MenuItem::ADMIN)
                ->route('#');
        });
        $mapDataMenu = Menu::get('map_data');
        $mapDataMenu->subMenu('ranches_list', function (MenuItem $menu) {
            $menu->key('ranches_list')
                ->type(MenuItem::ADMIN)
                ->label("Ranches List")
                ->route('admin.map-data.index')
                ->params("type=ranches");
        });
        $mapDataMenu->subMenu('professional_hunting_list', function (MenuItem $menu) {
            $menu->key('professional_hunting_list')
                ->type(MenuItem::ADMIN)
                ->label("Professional Hunting List")
                ->route('admin.map-data.index')
                ->params("type=professional_hunting");
        });
        $mapDataMenu->subMenu('taxidermy_list', function (MenuItem $menu) {
            $menu->key('taxidermy_list')
                ->type(MenuItem::ADMIN)
                ->label("Taxidermy List")
                ->route('admin.map-data.index')
                ->params("type=taxidermy");
        });
        $mapDataMenu->subMenu('processing_list', function (MenuItem $menu) {
            $menu->key('processing_list')
                ->type(MenuItem::ADMIN)
                ->label("Processing List")
                ->route('admin.map-data.index')
                ->params("type=processing");
        });

        /** How to video **/
        Menu::make('how_to_video', function (MenuItem $menu) {
            $menu->label('How To Video')
                ->type(MenuItem::ADMIN)
                ->route('#');
        });
        $mapDataMenu = Menu::get('how_to_video');
        $mapDataMenu->subMenu('how_to_video_list', function (MenuItem $menu) {
            $menu->key('how_to_video_list')
                ->type(MenuItem::ADMIN)
                ->label("List")
                ->route('admin.how-to-video.index');
        });


        Menu::make('system', function (MenuItem $menu) {
            $menu->label('avored::system.system')
                ->type(MenuItem::ADMIN)
//                ->icon('settings')
                ->route('#');
        });

        /** @var $systemMenu \AvoRed\Framework\Menu\MenuBuilder */
        $systemMenu = Menu::get('system');
        /** @var Builder $systemMenu */
        // $systemMenu->subMenu('configuration', function (MenuItem $menu) {
        //     $menu->key('configuration')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.configuration')
        //         ->route('admin.configuration.index');
        // });

        // $systemMenu->subMenu('currency', function (MenuItem $menu) {
        //     $menu->key('currency')
        //         ->type(MenuItem::ADMIN)
        //         ->label('avored::system.admin_menus.currency')
        //         ->route('admin.currency.index');
        // });

        $systemMenu->subMenu('role', function (MenuItem $menu) {
            $menu->key('role')
                ->type(MenuItem::ADMIN)
                ->label('avored::system.role')
                ->route('admin.role.index');
        });

        // Reported menu
        Menu::make('reported', function (MenuItem $menu) {
            $menu->key('reported')
                ->type(MenuItem::ADMIN)
                ->label('Reported')
                ->route('#');
        });
        $reportedMenu = Menu::get('reported');

        $reportedMenu->subMenu('list', function (MenuItem $menu) {
            $menu->key('list')
                ->type(MenuItem::ADMIN)
                ->label('List')
                ->route('admin.reported.index');
        });

        // admin.settings.index
        Menu::make('settings', function (MenuItem $menu) {
            $menu->key('settings')
                ->type(MenuItem::ADMIN)
                ->label('Settings')
                ->route('#');
        });
        $settingMenu = Menu::get('settings');

        $settingMenu->subMenu('payments', function (MenuItem $menu) {
            $menu->key('payments')
                ->type(MenuItem::ADMIN)
                ->label('Payments')
                ->route('admin.settings.payments');
        });

        $settingMenu->subMenu('contact', function (MenuItem $menu) {
            $menu->key('contact')
                ->type(MenuItem::ADMIN)
                ->label('Contact Page')
                ->route('admin.settings.contact');
        });
    }
}
