<?php
namespace Webshop\Model;

class Catalog
{
    private $_products = array();

    public function __construct() {

        $product1 = new \Webshop\Model\Catalog\Entity();
        $product1->setId(1);
        $product1->setName('Product 1');
        $product1->setPicture('product1.jpg');
        $product1->setDescription('Suspendisse posuere sollicitudin nisi dictum maximus. Donec semper volutpat semper. Proin dolor sapien, pulvinar.');
        $product1->setPrice('3243');
        $products[$product1->getId()] = $product1;

        $product2 = new \Webshop\Model\Catalog\Entity();
        $product2->setId(2);
        $product2->setName('Product 2');
        $product2->setPicture('product2.jpg');
        $product2->setDescription('Etiam et dapibus dui. Mauris at velit accumsan, bibendum lorem condimentum, consequat magna.');
        $product2->setPrice('212');
        $products[$product2->getId()] = $product2;

        $product3 = new \Webshop\Model\Catalog\Entity();
        $product3->setId(3);
        $product3->setName('Product 3');
        $product3->setPicture('product3.jpg');
        $product3->setDescription('Sed lacinia nec libero a dapibus. Pellentesque fringilla luctus sodales. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.');
        $product3->setPrice('11');
        $products[$product3->getId()] = $product3;

        $product4 = new \Webshop\Model\Catalog\Entity();
        $product4->setId(4);
        $product4->setName('Product 4');
        $product4->setPicture('product4.jpg');
        $product4->setDescription('Curabitur felis ex, dignissim vel venenatis faucibus, varius fringilla purus. Nunc id nibh ut augue sagittis tristique. Morbi eget sapien magna.');
        $product4->setPrice('12');
        $products[$product4->getId()] = $product4;

        $product5 = new \Webshop\Model\Catalog\Entity();
        $product5->setId(5);
        $product5->setName('Product 5');
        $product5->setPicture('product5.jpg');
        $product5->setDescription('Quisque lacinia enim mi, ut consectetur dolor lobortis at. Morbi vitae urna mollis, accumsan justo eget, venenatis tortor. Donec viverra lectus blandit, euismod mi id, pellentesque dui.');
        $product5->setPrice('15');
        $products[$product5->getId()] = $product5;

        $this->_products = $products;
    }

    public function fetchAll()
    {
      return $this->_products;
    }

    public function getProductById($id)
    {
        return $this->_products[$id];
    }
}