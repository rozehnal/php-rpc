<?php

namespace DixonsCz\Endpoints\PeakClimber\Countries;


use DixonsCz\Endpoints\Response;

class CountriesResponse extends Response
{

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