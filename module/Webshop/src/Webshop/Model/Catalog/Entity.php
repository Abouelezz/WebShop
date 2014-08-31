<?php
namespace Webshop\Model\Catalog;

class Entity
{
    protected $_id;
    protected $_name;
    protected $_description;
    protected $_picture;
    protected $_price;

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    public function getName() {
        return $this->_name;
    }

    public function setName($name) {
        $this->_name = $name;
        return $this;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function setDescription($description) {
        $this->_description = $description;
        return $this;
    }

    public function getPicture() {
        return $this->_picture;
    }

    public function setPicture($picture) {
        $this->_picture = $picture;
        return $this;
    }

    public function getPrice() {
        return $this->_price;
    }

    public function setPrice($price) {
        $this->_price = $price;
        return $this;
    }

}