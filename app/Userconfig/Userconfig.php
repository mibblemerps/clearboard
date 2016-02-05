<?php

namespace App\Userconfig;

use Illuminate\Support\Facades\Facade;

/**
 * Class Userconfig
 * @package App\Userconfig
 */
class Userconfig
{
    /**
     * Path to configuration file
     * @var string
     */
    protected $configPath;

    /**
     * Stores all user defined configuration objects.
     * @var \stdClass
     */
    protected $userconfig;

    /**
     * Are there pending changes to be saved to disk?
     * @var bool
     */
    protected $needsSave = false;

    /**
     * Should config changes be automatically flushed?
     * @var bool
     */
    public $autoflush = true;

    /**
     * Userconfig constructor.
     * @param string $configPath Path to configuration file.
     */
    public function __construct($configPath)
    {
        $this->configPath = $configPath;

        $this->loadConfig();
        $this->loadIntoRuntime();
    }

    /**
     * Apply the userconfig overrides into the runtime.
     */
    protected function loadIntoRuntime()
    {
        foreach ($this->userconfig as $group => $groupconfig) {
            foreach ($groupconfig as $key => $value) {
                config(["$group.$key" => $value]);
            }
        }
    }

    /**
     * Load configuration from file.
     *
     * @throws ConfigParseException
     */
    protected function loadConfig()
    {
        if (!file_exists($this->configPath)) {
            // User config does not exist. Create a blank one.
            file_put_contents($this->configPath, '{}');
        }

        $this->userconfig = json_decode(file_get_contents($this->configPath), true);
        if ($this->userconfig === null) {
            // Parse failed
            throw new ConfigParseException('Failed to parse configuration file: ' . $this->configPath);
        }
    }

    /**
     * Flush configuration changes to disk.
     */
    protected function flushConfig()
    {
        $json = json_encode($this->userconfig, JSON_PRETTY_PRINT);
        file_put_contents($this->configPath, $json);
    }

    /**
     * Read configuration value.
     * Wrapper around Laravel's standard configuration system.
     * You might as well just use the config() helper function.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return app('config')->get($key);
    }

    /**
     * Clear a value from userconfig.
     * Essentially resets to default.
     * @param $key
     */
    public function clear($key)
    {
        // Parse configuration key.
        $group = explode('.', $key)[0];
        $key = explode('.', $key)[1];

        // Clear value
        unset($this->userconfig[$group][$key]);

        // Cleanup group if applicable.
        if (count($this->userconfig[$group]) == 0) {
            unset($this->userconfig[$group]);
        }

        // Flush config changes to file.
        if ($this->autoflush) {
            // Automatically save changes.
            $this->flushConfig();
        }
    }

    /**
     * Set a user configuration value.
     *
     * @param string $key
     * @param string $value
     */
    public function set($key, $value)
    {
        if ($key === null) {
            // Null value, clear config value.
            return $this->clear($key);
        }

        // Parse configuration key.
        $group = explode('.', $key)[0];
        $key = explode('.', $key)[1];

        // Make change.
        $this->userconfig[$group][$key] = $value;

        // Reload config into runtime.
        $this->loadIntoRuntime();

        if ($this->autoflush) {
            // Automatically save changes.
            $this->flushConfig();
        }
    }
}