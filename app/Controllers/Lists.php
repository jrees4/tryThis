<?php

namespace App\Controllers;

helper('inflector');

use App\Models\Shopping_model;
use CodeIgniter\Model;

class Lists extends BaseController
{

    

    public function index()
    {
        if ( ! session_id() ) @ session_start();
        $model = model(Shopping_model::class);
        // $model = $this->load->model('Shopping_model');

        $data = [
            'test' => 'Test123',
        ];

        if(isset($_SESSION['ListID'])){
            $id = $_SESSION['ListID'];
            $listData = $model->getList($id);
             
            $data = [
                // 'listID' => $listData['_id'],
                'testID' => $_SESSION['ListID'],
                'listData' => $listData['foodIDs'],
            ];
    
        }
        
        echo view('Header_view', $data);
        echo view('List_view', $data);
        echo view('Footer_view', $data);
    }

    public function create()
    {
        if ( ! session_id() ) @ session_start();
        if(!isset($_SESSION['ListID'])){
            $model = model(Shopping_model::class);

            $model->createList();

            return redirect()->to('public/list');
        }else{
            echo 'You already have a list..';
            return redirect()->to('public/list');
        }
    }

    // this whole thing is broken. aaaaaaaa
    public function foodAdd($id){
        if ( ! session_id() ) @ session_start();
        
       
        //  // We don't have to parse the list ID because it's in the session cookies
        //  $id = $_SESSION['ListID'];
        //  echo '----';
        //  echo $id;

        // Get inputs from JS
        //  $foodID = $this->input->post('foodID');
        //  echo(json_encode($foodID));


        $model = model(Shopping_model::class);
        $model->foodAdd($id);
        
        return redirect()->to('public/food');
        // $this->index();
    }

    public function delete($segment = null) {
        if ( ! session_id() ) @ session_start();
        
        session_destroy();


        if ( ! session_id() ) @ session_start();
        $this->create();

        // if (!empty($segment) && $this->request->getMethod() == 'get') {
        //     $model = model(Shopping_model::class);
        //     $model->deleteFood($segment);
        // }

        return redirect()->to('public/list');
    }
}