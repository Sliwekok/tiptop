<?php namespace Sliwek\Mail;

use Backend;
use System\Classes\PluginBase;

/**
 * Mail Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Mail',
            'description' => 'No description provided yet...',
            'author'      => 'sliwek',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Sliwek\Mail\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'sliwek.mail.some_permission' => [
                'tab' => 'Mail',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'mail' => [
                'label'       => 'Mail',
                'url'         => Backend::url('sliwek/mail/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['sliwek.mail.*'],
                'order'       => 500,
            ],
        ];
    }
}
