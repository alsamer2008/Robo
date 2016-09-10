<?php
namespace Robo;

class Config
{
    const PROGRESS_BAR_AUTO_DISPLAY_INTERVAL = 'progress-delay';
    const SIMULATE = 'simulate';
    const SUPRESS_MESSAGES = 'supress-messages';
    const DECORATED = 'decorated';

    protected $config = [];

    public function get($key, $default = null)
    {
        return isset($this->config[$key]) ? $this->config[$key] : $default;
    }

    public function set($key, $value)
    {
        $this->config[$key] = $value;
        return $this;
    }

    public function getGlobalOptionDefaultValues()
    {
        $globalOptions =
        [
            self::PROGRESS_BAR_AUTO_DISPLAY_INTERVAL => 2,
            self::SIMULATE => false,
            self::SUPRESS_MESSAGES => false,
        ];

        return $globalOptions;
    }

    public function setGlobalOptions($input)
    {
        $globalOptions = $this->getGlobalOptionDefaultValues();

        foreach ($globalOptions as $option => $default) {
            $value = $input->hasOption($option) ? $input->getOption($option) : null;
            // Unfortunately, the `?:` operator does not differentate between `0` and `null`
            if (!isset($value)) {
                $value = $default;
            }
            $this->set($option, $value);
        }
    }

    public function isSimulated()
    {
        return $this->get(self::SIMULATE);
    }

    public function setSimulated($simulated = true)
    {
        return $this->set(self::SIMULATE, $simulated);
    }

    public function isDecorated()
    {
        return $this->get(self::DECORATED);
    }

    public function setDecorated($decorated = true)
    {
        return $this->set(self::DECORATED, $decorated);
    }

    public function isSupressed()
    {
        return $this->get(self::SUPRESS_MESSAGES);
    }

    public function setSupressed($supressed = true)
    {
        return $this->set(self::SUPRESS_MESSAGES, $supressed);
    }

    public function setProgressBarAutoDisplayInterval($interval)
    {
        return $this->set(self::PROGRESS_BAR_AUTO_DISPLAY_INTERVAL, $interval);
    }
}
