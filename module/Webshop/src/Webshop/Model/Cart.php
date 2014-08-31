<?php
namespace Webshop\Model;

use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;

class Cart
{
    private $_items = array();
    private $_itemsCount = 0;
    private $_total = 0;
    private $_cartSession;

    public function __construct()
    {
        $this->_cartSession     = new Container('cart');
        $this->_items           = $this->_cartSession->items;
        $this->_total           = $this->_cartSession->total ? $this->_cartSession->total : 0;
        $this->_itemsCount      = $this->_cartSession->itemsCount ? $this->_cartSession->itemsCount : 0;
    }

    public function getItems()
    {
        return $this->_items;
    }

    public function getTotal()
    {
        return $this->_total;
    }

    public function getItemsCount()
    {
        return $this->_itemsCount;
    }

    public function addItem(\Webshop\Model\Catalog\Entity $product, $qty)
    {
        if ($qty <= 0 ) {
           return false;
        }

        if (!isset($this->_items[ $product->getId() ])) {
            $item = new \Webshop\Model\Cart\Entity();
            $item->setProduct($product);
            $item->setQty($qty);
            $item->setId( $product->getId() );
            $this->_items[ $item->getId() ] = $item;
        } else {
            $this->updateItem($this->getItemById($product->getId()),
                $this->getItemById($product->getId())->getQty() +  $qty);
        }



        $this->_calculateTotals();
        $this->_saveToSession();

        return $this->_items;
    }

    public function removeItem(\Webshop\Model\Cart\Entity $item)
    {
        unset($this->_items[$item->getId()]);
        $this->_calculateTotals();
        $this->_saveToSession();
    }

    public function updateItem(\Webshop\Model\Cart\Entity $item, $qty)
    {
        if ($qty <= 0) {
            unset($this->_items[ $item->getId() ]);
        } else {
            $this->getItemById($item->getId())->setQty($qty);
        }

        $this->_calculateTotals();
        $this->_saveToSession();

    }

    public function _calculateTotals()
    {
        $sub = 0;
        $subCount = 0;
        foreach ($this->_items as $item) {
            $sub        = $sub + $item->getCost();
            $subCount   = $subCount +  $item->getQty();
        }
        $this->_total       = $sub;
        $this->_itemsCount  = $subCount;
    }

    public function getItemById($id)
    {
        return $this->_items[$id];
    }

    private function _saveToSession()
    {
        $this->_cartSession->items          = $this->_items;
        $this->_cartSession->total          = $this->_total;
        $this->_cartSession->itemsCount     = $this->_itemsCount;
    }
}