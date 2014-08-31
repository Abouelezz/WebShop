<?php
namespace Webshop\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class IndexController extends AbstractActionController
{
    private $_cartModel;
    private $_catalogModel;

    public function __construct()
    {
        $this->_cartModel = new \Webshop\Model\Cart();
        $this->_catalogModel = new \Webshop\Model\Catalog();
    }

    public function indexAction()
    {

        return new ViewModel( array(
            'products'      => $this->_catalogModel->fetchAll(),
            'itemsCount'    => $this->_cartModel->getItemsCount()
        ));
    }

    public function viewAction()
    {
        $id  = (int) $this->getEvent()->getRouteMatch()->getParam('id');

        $catalogModel = new \Webshop\Model\Catalog();
        return new ViewModel( array(
            'product'       => $this->_catalogModel->getProductById($id),
            'itemsCount'    => $this->_cartModel->getItemsCount()
        ));
    }
}
