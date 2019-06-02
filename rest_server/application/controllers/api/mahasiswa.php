<?php
// include this
 use Restserver\Libraries\REST_Controller;
 defined('BASEPATH') OR exit('No direct script access allowed');

 require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

// start controller
 class Mahasiswa extends REST_Controller
 {
     
     public function __construct()
     {
         parent::__construct();
         $this->load->model('m_mahasiswa');
         $this->methods['index_get']['limit'] = 100;//untuk methods index_get() perjam hanya 100 kali hits
         
     }

    //  request methode GET for view data
     
    public function index_get()//index_get() adalah standar untug Rest GET
    {
        $id= $this->get('id');//dari methode get, ambil key 'id' 
        if($id===null){ //jka $id kosong
            $mahasiswa = $this->m_mahasiswa->getdata('mahasiswa')->result_array();//get semua data pada tabel mahasiswa dan dijadikan array assosiatif
        }else{
            $id= $this->get('id');//dari methode get ambil 'id'
            $w=array('id'=>$id); //array untuk where
            $mahasiswa =$this->m_mahasiswa->getdata_where($w,'mahasiswa')->result_array(); //perintah db ambil data pada tabel mahasiswa yang memilii id=$id kemudian simpan ke $mahasiswa dengan hasil array assosiatif.
        }
        
        if($mahasiswa){ //jika data ada
            $this->response([
                'status' => true, //status= true
                'data' => $mahasiswa //data= $mahasiswa
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false, //status= false
                'message' => 'id not fount' //message not found
            ], REST_Controller::HTTP_NOT_FOUND);// status http menjadi 404 notfound
        }
    }

    // request methode DELETE for delete data with rest server
    public function index_delete(){
         $id=$this->delete('id'); //ambil value dari key id
         if ($id===null){ //jika id samadengan kosong
            $this->response([
                'status' => false, //status= false
                'message' => 'provide id' //message not found
            ], REST_Controller::HTTP_BAD_REQUEST);// status http menjadi 400 BAD REQUEST
         }else{ //selain itu

            $id=$this->delete('id'); //ambil value dari key id
            $w = array('id' => $id ); //where id=$id

             if($this->m_mahasiswa->delete('mahasiswa',$w) > 0){ //jika berhasil menjalankan m_mahasiswa delete dan diatas 0
                $this->response([
                    'status' => true, //status= true
                    'id'=> $id,
                    'message' => 'deleted' //message not found
                ], REST_Controller::HTTP_OK); //204 no content
             }else{ //selain itu

                $this->response([
                    'status' => false, //status= false
                    'message' => 'id not found' //message not found
                ], REST_Controller::HTTP_BAD_REQUEST); //400 bad request

             }

         }
    }

    // request methode POST for add data with rest server
    public function index_post(){
        $data = array(
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        );

        if($this->m_mahasiswa->add('mahasiswa',$data) > 0){
            $this->response([
                'status' => true, //status= true
                'message' => 'new data has been added' //message not found
            ], REST_Controller::HTTP_CREATED); //201 created
        }else {
            $this->response([
                'status' => false, //status= false
                'message' => 'fail to add data' //message not found
            ], REST_Controller::HTTP_BAD_REQUEST); //400 bad request
        }
    }

    // request methode PUT for edit data with rest server
    public function index_put(){
        $id=$this->put('id');
        $w=array('id'=>$id);
        $data = array(
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan')
        );
            
        
        if($this->m_mahasiswa->update('mahasiswa',$data,$w) > 0){
            $this->response([
                'status' => true, //status= true
                'message' => 'new data has been Update' //message not found
            ], REST_Controller::HTTP_OK); //204 created
        }else {
            $this->response([
                'status' => false, //status= false
                'message' => 'fail to update data' //message not found
            ], REST_Controller::HTTP_BAD_REQUEST); //400 bad request
        }
    }
 }

?>