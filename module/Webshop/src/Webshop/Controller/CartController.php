<?php
namespace Webshop\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class CartController extends AbstractActionController
{
    private $_cartModel;

    public function __construct()
    {
        $this->_cartModel = new \Webshop\Model\Cart();
    }

    public function indexAction()
    {

        return new ViewModel( array(
            'items'         => $this->_cartModel->getItems(),
            'total'         => $this->_cartModel->getTotal(),
            'itemsCount'    => $this->_cartModel->getItemsCount()
        ));
    }

    public function addAction()
    {
        $id  = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $qty = (int) $this->getEvent()->getRouteMatch()->getParam('qty');

        if (!$qty) {
            $qty = (int) $this->params()->fromQuery('qty');
        }


        if ($qty <= 0) {
            throw new \Exception('Product could not be added with 0 qty to cart');
        }

        $catalog = new \Webshop\Model\Catalog();

        $product = $catalog->getProductById($id);

        if (null === $product) {
            throw new \Exception('Product is not exist');
        }

        $this->_cartModel->addItem($product, $qty);


        return $this->redirect()->toRoute('cart');
    }

    public function removeAction()
    {
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');

        $item = $this->_cartModel->getItemById($id);

        if (null === $item) {
            throw new \Exception('Product is not exist in your shopping cart');
        }

        $this->_cartModel->removeItem($item);

        return $this->redirect()->toRoute('cart');
    }

    public function updateAction()
    {

        $id     = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        $qty    = (int) $this->params()->fromQuery('qty');
        $item   = $this->_cartModel->getItemById($id);

        if (null === $item) {
            throw new \Exception('Product is not exist in your shopping cart');
        }

        $this->_cartModel->updateItem($item, $qty);

        return $this->redirect()->toRoute('cart');
    }
}
