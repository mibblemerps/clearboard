<?php

namespace App\Providers;

use Configuration\ConfigParseException;
use Illuminate\Support\ServiceProvider;

/**
 * The configuration service provider overrides existing config entires located within /config with user defined values
 * located in JSON files inside /userconfig.
 *
 * This allows writing new configuration values.
 *
 * @package App\Providers
 */
class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Overrides the config from user configs.
     *
     * @throws Exception
     */
    public function loadConfig()
    {
        foreach (scandir(base_path('userconfig')) as $configfilename) {
            $configfile = base_path('userconfig/' . $configfilename);

            if (!is_file($configfile)) {
                // Not config file.
                continue;
            }

            // Parse config file.
            $config = json_decode(file_get_contents($configfile));
            if ($config === null) {
                throw new \Exception('Unable to parse config file: ' . $configfile);
            }

            // Apply configuration changes.
            foreach ($config as $group => $groupconfig) {
                foreach ($groupconfig as $key => $value) {
                    config(["$group.$key" => $value]);
                }
            }
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->loadConfig();
    }
}
