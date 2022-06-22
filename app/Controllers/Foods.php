<?php

namespace App\Controllers;

helper('inflector');

use App\Models\Shopping_model;
use CodeIgniter\Model;

class Foods extends BaseController
{
    public function index()
    {
        if ( ! session_id() ) @ session_start();
        $model = model(Shopping_model::class);
        // $model = $this->load->model('Shopping_model');

        $data = [
            'foods' => $model->getfoods(),
        ];

        echo view('Header_view', $data);
        echo view('FoodPicker_view', $data);
        echo view('Footer_view', $data);
    }

    public function create()
    {
        if ( ! session_id() ) @ session_start();
        if(isset($_SESSION['ListID'])){
            // return redirect()->to('lists');
        }

        $model = model(Shopping_model::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'name' => 'required|min_length[1]|max_length[255]',
            'cost' => 'required|is_natural_no_zero',
            'description' => 'required|min_length[0]|max_length[255]',
        ])) {
            $model->insertFood(
                $this->request->getPost('name'),
                $this->request->getPost('cost'),
                $this->request->getPost('description'),
            );

            // return redirect()->to('index');
            $this->index();
        } else {
            echo view('Header_view');
            echo view('Create_view', ['title' => 'Add a new food']);
            echo view('Footer_view');
        }
    }

    public function delete($segment = null) {
        if (!empty($segment) && $this->request->getMethod() == 'get') {
            $model = model(Shopping_model::class);
            $model->deleteFood($segment);
        }

        return redirect()->to('food');
    }
}