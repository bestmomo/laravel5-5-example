<?php

namespace App\Repositories;

class EnvRepository
{
    /**
     * @var string
     */
    protected $envPath;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $env;

    /**
     * @var string
     */
    protected $configEnv;

    /**
     * Create a new EnvRepository instance.
     */
    public function __construct()
    {
        $this->envPath = base_path('.env');

        $this->env = $this->buildCollection ();

        $this->configEnv = file_get_contents ($this->envPath);
    }

    /**
     * Build env collection
     *
     * @return \Illuminate\Support\Collection
     */
    protected function buildCollection()
    {
        return collect(file($this->envPath))
        ->filter(function($value) {
            return strlen ($value) > 2;
        })->mapWithKeys(function ($item) {
            $result = explode('=', $item);
            if (count($result) > 1) {
                return [$result[0] => preg_replace('/[\r\n]+/', '', $result[1])];
            }
            return [$result[0] => ''];
        });
    }

    /**
     * Get .env element.
     *
     * @param string $key
     * @return string
     */
    public function get($key)
    {
        return $this->env->get ($key);
    }

    /**
     * Update env.
     *
     * @param array $inputs
     */
    public function update($inputs)
    {
        foreach ($inputs as $key => $value) {
            $key = strtoupper ($key);
            if ($this->get($key) != $value) {
                $this->configEnv = preg_replace ("/($key=)(.*)/", '${1}' . $value, $this->configEnv);
            }
        }

        file_put_contents($this->envPath, $this->configEnv);
    }
}