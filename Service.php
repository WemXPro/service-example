<?php

namespace App\Services\Example;

use App\Models\Order;

class Service
{
    /**
     * Unique key used to store settings 
     * for this service.
     * 
     * @return string
     */
    public static $key = 'example'; 

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    
    /**
     * Returns the meta data about this Server/Service
     *
     * @return object
     */
    public static function metaData(): object
    {
        return (object)
        [
          'display_name' => 'Example',
          'autor' => 'WemX',
          'version' => '1.0.0',
          'wemx_version' => ['dev', '>=1.8.0'],
        ];
    }

    /**
     * Define the default configuration values required to setup this service
     * i.e host, api key, or other values. Use Laravel validation rules for
     *
     * Laravel validation rules: https://laravel.com/docs/10.x/validation
     *
     * @return array
     */
    public static function setConfig(): array
    {
        return [
            "encrypted::pterodactyl::api_url" => [
                "name" => "Host",
                "description" => "The hostname of your Pterodactyl Panel i.e panel.example.com",
                "type" => "text", // text, textarea, password, number, date, checkbox, url, email, select
                "rules" => ['required'], // laravel validation rules
            ],
            "encrypted::pterodactyl::api_key" => [
                "name" => "API Key",
                "description" => "The API key for your Pterodactyl Panel",
                "type" => "password",
                "rules" => ['required'], // laravel validation rules
            ],
            "encrypted::pterodactyl::sso_secret" => [
                "name" => "SSO Secret Key",
                "description" => "The SSO key used for automating logging in to Pterodactyl Panel",
                "type" => "password",
                "rules" => ['nullable'], // laravel validation rules
            ]
        ];
    }

    /**
     * Define the default package configuration values required when creatig
     * new packages. i.e maximum ram usage, allowed databases and backups etc.
     *
     * Laravel validation rules: https://laravel.com/docs/10.x/validation
     *
     * @return array
     */
    public static function setPackageConfig(): array
    {
        return [
            [
                "key" => "database_limit",
                "name" => "Database Limit",
                "description" => "The total number of databases a user is allowed to create for this server on Pterodactyl Panel.",
                "type" => "number",
                "rules" => ['required'], // laravel validation rules
            ],
            [
                "key" => "allocation_limit",
                "name" => "Allocation Limit",
                "description" => "The total number of allocations a user is allowed to create for this server Pterodactyl Panel.",
                "type" => "number",
                "rules" => ['required'],
            ],
            [
                "key" => "backup_limit",
                "name" => "Backup Limit",
                "description" => "The total number of backups that can be created for this server Pterodactyl Panel.",
                "type" => "number",
                "rules" => ['required'],
            ],
            [
                "key" => "cpu_limit",
                "name" => "CPU Limit in %",
                "description" => "If you do not want to limit CPU usage, set the value to0. To use a single thread set it to 100%, for 4 threads set to 400% etc",
                "type" => "number",
                "rules" => ['required'],
            ],
            [
                "key" => "memory_limit",
                "name" => "Memory Limit in MB",
                "description" => "The maximum amount of memory allowed for this container. Setting this to 0 will allow unlimited memory in a container.",
                "type" => "number",
                "rules" => ['required'],
            ],
            [
                "key" => "disk_limit",
                "name" => "Disk Limit in MB",
                "description" => "The maximum amount of memory allowed for this container. Setting this to 0 will allow unlimited memory in a container.",
                "type" => "number",
                "rules" => ['required'],
            ],
            [
                "key" => "country[]",
                "name" => "Select Country",
                "description" => "The maximum amount of memory allowed for this container. Setting this to 0 will allow unlimited memory in a container.",
                "type" => "select",
                "options" => [
                    'test', 'test2', 'test10', 'test20',
                ],
                "default_value" => 1,
                "multiple" => true,
                "rules" => [''],
            ],
        ];
    }

    /**
     * Define the checkout config that is required at checkout and is fillable by
     * the client. Its important to properly sanatize all inputted data with rules
     *
     * Laravel validation rules: https://laravel.com/docs/10.x/validation
     *
     * @return array
     */
    public static function setCheckoutConfig(): array
    {
        return [
            [
                "key" => "database_limit",
                "name" => "Database Limit",
                "description" => "The total number of databases a user is allowed to create for this server on Pterodactyl Panel.",
                "type" => "text",
                "rules" => ['required'], // laravel validation rules
            ],
        ];    
    }

    /**
     * Define buttons shown at order management page
     *
     * @return array
     */
    public static function setServiceButtons(): array
    {
        $login_to_panel = settings('encrypted::pterodactyl::sso_secret') ? [
            "name" => __('client.login_to_panel'),
            "icon" => '<i class="bx bx-terminal"></i>',
            "color" => "primary",
            "href" => route('pterodactyl.login'),
            "target" => "_blank",
        ] : [];

        $server_ip = [
            "name" => '123.456.83.231',
            "color" => "primary",
        ];

        return [$login_to_panel, $server_ip];    
    }

    /**
     * This function is responsible for creating an instance of the
     * service. This can be anything such as a server, vps or any other instance.
     * @return Renderable
     */
    public function create(array $data = [])
    {
        return [];
    }

    /**
     * This function is responsible for suspending an instance of the
     * service. This method is called when a order is expired or
     * suspended by an admin
     * @return Renderable
    */
    public function suspend(array $data = [])
    {
        return [];
    }

    /**
     * This function is responsible for unsuspending an instance of the
     * service. This method is called when a order is activated or
     * unsuspended by an admin
     * @return Renderable
    */
    public function unsuspend(array $data = [])
    {
        return [];
    }

    /**
     * This function is responsible for deleting an instance of the
     * service. This can be anything such as a server, vps or any other instance.
     * @return Renderable
    */
    public function terminate(array $data = [])
    {
        return [];
    }

}
