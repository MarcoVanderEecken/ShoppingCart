<?php
/**
 * Created by PhpStorm.
 * User: Temporary
 * Date: 7/21/2017
 * Time: 9:50 AM
 *
 * This is a product shopping cart.
 *
 */
    class ProductItem{
        //this is a product item. It has the same details as the product table.

        private $productID;
        private $productName;
        private $productDescription;
        private $productStock;
        private $productPrice;

        /**
         * ProductItem constructor.
         * @param $productID
         * @param $productName
         * @param $productDescription
         * @param $productStock
         * @param $productPrice
         */
        public function __construct($productID, $productName, $productDescription, $productStock, $productPrice)
        {
            $this->productID = $productID;
            $this->productName = $productName;
            $this->productDescription = $productDescription;
            $this->productStock = $productStock;
            $this->productPrice = $productPrice;
        }

        /**
         * @return mixed
         */
        public function getProductID()
        {
            return $this->productID;
        }

        /**
         * @param mixed $productID
         */
        public function setProductID($productID)
        {
            $this->productID = $productID;
        }

        /**
         * @return mixed
         */
        public function getProductName()
        {
            return $this->productName;
        }

        /**
         * @param mixed $productName
         */
        public function setProductName($productName)
        {
            $this->productName = $productName;
        }

        /**
         * @return mixed
         */
        public function getProductDescription()
        {
            return $this->productDescription;
        }

        /**
         * @param mixed $productDescription
         */
        public function setProductDescription($productDescription)
        {
            $this->productDescription = $productDescription;
        }

        /**
         * @return mixed
         */
        public function getProductStock()
        {
            return $this->productStock;
        }

        /**
         * @param mixed $productStock
         */
        public function setProductStock($productStock)
        {
            $this->productStock = $productStock;
        }

        /**
         * @return mixed
         */
        public function getProductPrice()
        {
            return $this->productPrice;
        }

        /**
         * @param mixed $productPrice
         */
        public function setProductPrice($productPrice)
        {
            $this->productPrice = $productPrice;
        }



    }