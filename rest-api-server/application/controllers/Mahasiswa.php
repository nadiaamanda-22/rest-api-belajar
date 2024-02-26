<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'Mhs');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $mhs = $this->Mhs->getData($id);

        if ($mhs) {
            $this->response([
                'status' => 'true',
                'data' => $mhs
            ], RestController::HTTP_OK);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id == null) {
            $this->response([
                'status' => 'false',
                'message' => 'please input id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Mhs->delData($id) > 0) {
                $this->response([
                    'status' => 'true',
                    'message' => 'deleted data!'
                ]);
            } else {
                $this->response([
                    'status' => 'false',
                    'message' => 'undefined id!'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        if ($this->Mhs->addData($data) > 0) {
            $this->response([
                'status' => 'true',
                'message' => 'data added!'
            ], RestController::HTTP_OK);
        }
    }

    public function index_put()
    {

        $id = $this->put('id');

        $data = [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan')
        ];

        if ($id == null) {
            $this->response([
                'status' => 'false',
                'message' => 'please input id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->Mhs->updateData($id, $data) > 0) {
                $this->response([
                    'status' => 'true',
                    'message' => 'data updated!'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => 'false',
                    'message' => 'undefined id!'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }
}
