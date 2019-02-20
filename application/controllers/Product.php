    <?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    require(APPPATH . '/libraries/REST_Controller.php');
    require(APPPATH . '/libraries/Format.php');

    use Restserver\Libraries\REST_Controller;

    /**
     * class Product 
     * also act as a controller extends REST Controller      
     */
    class Product extends REST_Controller
    {
        /**
         * no arg constructor
         * @return void
         */
        function __construct()
        {
            parent::__construct();
        }

        /**
         * function to get all the products
         * @return void
         */
        public function find_all_get()
        {
            $data = json_encode($this->ProductModel->findall());
            print_r($data);
        
        }

        /**
         * function to get product by passing id
         * @param id id of product
         * @return void
         */
        public function find_get($id)
        {
            echo json_encode($this->ProductModel->find($id));
        }

        /**
         * function to create a new product
         * @return void
         */
        public function create_post()
        {
            $prod = array(
            $this->post('id'),
            $this->post('name'),
            $this->post('price'),
            $this->post('quantity'));
            $d = $this->ProductModel->insert($prod);
                print_r($d);
        }

        /**
         * function to update the existing user
         * @return void
         */
        public function update_put()
        {
            $prod = array(        
            $this->put('name'),
            $this->put('price'),
            $this->put('quantity'));
            $this->ProductModel->update($this->put('id'),$prod);
        }

        /**
         * function to delete the user
         * @param id id of product to be deleted
         * @return void
         */
        public function delete_delete($id)
        {
            $this->ProductModel->delete($id);
        }
    }

    ?>