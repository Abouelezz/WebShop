<?php
namespace Webshop\Model\Cart;

class Entity
{
    protected $_id;
    protected $_product;
    protected $_qty;

    public function getId() {
        return $this->_id;
    }

    public function setId($id) {
        $this->_id = $id;
        return $this;
    }

    public function getProduct() {
        return $this->_product;
    }

    public function setProduct(\Webshop\Model\Catalog\Entity $product) {
        $this->_product = $product;
        return $this;
    }

    public function getQty() {
        return $this->_qty;
    }

    public function setQty($qty) {
        $this->_qty = $qty;
        return $this;
    }

    public function getCost() {
        return (float)($this->_product->getPrice() * $this->_qty);
    }



}