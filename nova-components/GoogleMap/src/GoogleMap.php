<?php

namespace Masalitina\GoogleMap;

use Laravel\Nova\Fields\Field;

class GoogleMap extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'google-map';

    private $latitude;
    private $longitude;

    public function setLat($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    public function setLng($longitude)
    {
        $this->longitude = $longitude;
        return $this;
    }

    public function hues(array $hues)
    {
        return $this->withMeta(['hues' => $hues]);
    }

    public function init()
    {
        return $this->hues(['latitude'=>$this->latitude, 'longitude' => $this->longitude]);
    }
}

