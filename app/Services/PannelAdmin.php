<?php

namespace App\Services;

class PannelAdmin
{

    /**
     * @var array
     */
    protected $infos;

    /**
     * Pannel color
     * @var string
     */
    public $color;

    /**
     * Pannel icon
     * @var string
     */
    public $icon;

    /**
     * Pannel model
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;

    /**
     * Pannel number
     * @var string
     */
    public $nbr;

    /**
     * Pannel name
     * @var string
     */
    public $name;

    /**
     * Pannel url
     * @var string
     */
    public $url;

   /**
     * Create a new Admin instance.
     *
     * @param  array $infos
     */
    public function __construct(array $infos)
    {
        $this->color = $infos['color'];
        $this->icon = $infos['icon'];
        $this->model = new $infos['model'];
        $this->name = __($infos['name']);
        $this->url = $infos['url'];
        $this->nbr = $this->getNumber ();
    }

    /**
     * Get new records number the pannel
     *
     * @return integer
     */
    protected function getNumber()
    {
        return $this->model->has('ingoing')->count();
    }
}
