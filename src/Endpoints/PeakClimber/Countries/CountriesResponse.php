<?php

namespace DixonsCz\Endpoints\PeakClimber\Countries;


class CountriesResponse
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getRawData()
    {
        return $this->data;
    }


    public function getCreatedAt()
    {
        return $this->data['created_at'];
    }

    public function getUpdatedAt()
    {
        return $this->data['updated_at'];
    }

    public function getId()
    {
        return $this->data['id'];
    }

    public function getName()
    {
        return $this->data['name'];
    }

}