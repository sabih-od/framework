<?php

use AvoRed\Framework\Graphql\Mutations\Customer\CreateSubscriberMutation;
use AvoRed\Framework\Graphql\Queries\CartItems;
use AvoRed\Framework\Graphql\Queries\CartItemsQuery;
use AvoRed\Framework\Graphql\Queries\CountryOptionsQuery;
use AvoRed\Framework\Graphql\Types\OptionType;
use AvoRed\Framework\Graphql\Types\SubscriberType;

return [

    /*
    |--------------------------------------------------------------------------
    | AvoRed Config Information
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */
    'admin_url' => 'admin',
    'guest_prefix' => 'AvoRed_Guest_',

    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin-users',
            ],
            'visitor_api' => [
                'driver' => 'passport',
                'provider' => 'visitors',
            ],
        ],
        'providers' => [
            'admin-users' => [
                'driver' => 'eloquent',
                'model' => AvoRed\Framework\Database\Models\AdminUser::class,
            ],
            'visitors' => [
                'driver' => 'eloquent',
                'model' => AvoRed\Framework\Database\Models\Visitor::class,
            ],
        ],

        'passwords' => [
            'adminusers' => [
                'provider' => 'admin-users',
                'table' => 'admin_password_resets',
                'expire' => 60,
            ],
        ],
    ],
    'graphql' => [
        'default_schema' => 'default',
        'schemas' => [
            'default' => [
                'query' => [
                    'latestProductQuery' => \AvoRed\Framework\Graphql\Queries\LatestProductQuery::class,
                    'allCategory' => \AvoRed\Framework\Graphql\Queries\AllCategoryQuery::class,
                    'allAddress' => \AvoRed\Framework\Graphql\Queries\AllAddressQuery::class,
                    'allOrders' => \AvoRed\Framework\Graphql\Queries\AllOrdersQuery::class,
                    'customerQuery' => \AvoRed\Framework\Graphql\Queries\CustomerQuery::class,
                    'addressQuery' => \AvoRed\Framework\Graphql\Queries\AddressQuery::class,
                    'category' => \AvoRed\Framework\Graphql\Queries\CategoryQuery::class,
                    'cartItems' => CartItemsQuery::class,
                    'countryOptions' => CountryOptionsQuery::class,
                    // customer order query api
                    'paymentQuery' => \AvoRed\Framework\Graphql\Queries\PaymentQuery::class,
                    'shippingQuery' => \AvoRed\Framework\Graphql\Queries\ShippingQuery::class,
                ],
                'mutation' => [
                    'CreateSubscriberMutation' => CreateSubscriberMutation::class,
                    'register' => \AvoRed\Framework\Graphql\Mutations\Auth\RegisterMutation::class,
                    'login' => \AvoRed\Framework\Graphql\Mutations\Auth\LoginMutation::class,
                    'customerUpdate' => \AvoRed\Framework\Graphql\Mutations\Customer\CustomerUpdateMutation::class,
                    'createAddress' => \AvoRed\Framework\Graphql\Mutations\Customer\CreateAddressMutation::class,
                    'updateAddress' => \AvoRed\Framework\Graphql\Mutations\Customer\UpdateAddressMutation::class,
                    'deleteAddress' => \AvoRed\Framework\Graphql\Mutations\Customer\DeleteAddressMutation::class,
                    'placeOrder' => \AvoRed\Framework\Graphql\Mutations\PlaceOrderMutation::class,
                    'addToCart' => \AvoRed\Framework\Graphql\Mutations\Cart\AddToCartMutation::class,
                    'deleteCart' => \AvoRed\Framework\Graphql\Mutations\Cart\DeleteCartMutation::class,
                ],
                'middleware' => [],
                'method'     => ['get', 'post'],
            ],
            'secret' => [
                'query' => [
                    'order' => \AvoRed\Framework\Graphql\Queries\OrderQuery::class,
                ],
                'mutation' => [],
                'middleware' => ['auth:api'],
                'method'     => ['get', 'post'],
            ],
        ],

        'types' => [
            // 'menu' => AvoRed\Framework\Graphql\Types\MenuType::class,
            'category' => AvoRed\Framework\Graphql\Types\CategoryType::class,
            // 'filter' => AvoRed\Framework\Graphql\Types\FilterType::class,
            'product' => AvoRed\Framework\Graphql\Types\ProductType::class,
            'token' => AvoRed\Framework\Graphql\Types\TokenType::class,
            'customer' => AvoRed\Framework\Graphql\Types\CustomerType::class,
            // 'cartProduct' => AvoRed\Framework\Graphql\Types\CartProductType::class,
            'order' => AvoRed\Framework\Graphql\Types\OrderType::class,
            'address' => AvoRed\Framework\Graphql\Types\AddressType::class,
            'delete' => AvoRed\Framework\Graphql\Types\DeleteType::class,
            'cartProduct' => AvoRed\Framework\Graphql\Types\CartProductType::class,
            'payment' => AvoRed\Framework\Graphql\Types\PaymentType::class,
            'shipping' => AvoRed\Framework\Graphql\Types\ShippingType::class,
            'subscriber' => SubscriberType::class,
            'option' => OptionType::class,
        ],
    ],
];
