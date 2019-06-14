<?php 
use GuzzleHttp\Client;//namespace guzzle
class Mahasiswa_model extends CI_model {

    private $_client;

    
    public function __construct()
    {
        
        $this->_client = new Client([ //instansiasi Client
            'base_uri'=> 'http://localhost/rest_api/rest_server/api/', //request methode get dengan link http localhost/....
            'auth'=>['admin','1234']//parameter auth [admin,password]
        ]);
    }
    
    public function getAllMahasiswa()
    {
        //return $this->db->get('mahasiswa')->result_array();
         $response = $this->_client->request('GET','mahasiswa',[//request controller mahasiswa
             'query' => [//params yang dikirim saat get. dan hanya ada di params
                 'apikey'=>'generatekey1'//apikey
             ]
         ]);

         $result = json_decode($response->getBody()->getContents(),true);//decode json menjadi array disimpan ke $result
         return $result['data'];//kembalikan $result yang di dalamnya ada array data
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            'apikey'=>'generatekey1'
        ];

        //$this->db->insert('mahasiswa', $data);

        $response = $this->_client->request('POST','mahasiswa',[ //request dengan methode POST, kecontroller mahasiswa, dengan form params
            'form_params'=> $data//form params isi dengan $data
        ]);

        $result = json_decode($response->getBody()->getContents(),true);//decode json menjadi array disimpan ke $result
        return $result;//kembalikan $result 
    }

    public function hapusDataMahasiswa($id)
    {
        
        //$this->db->delete('mahasiswa', ['id' => $id]);

        $response = $this->_client->request('DELETE','mahasiswa',[//request methode DELETE dengan parameter form_params
            'form_params'=>[
                'id'=>$id,//id yang di delete
                'apikey'=>'generatekey1'//apikey
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(),true);//decode json menjadi array disimpan ke $result
        return $result;//kembalikan $result 
    }

    public function getMahasiswaById($id)
    {
       // return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
       $response = $this->_client->request('GET','mahasiswa',[
           'query' => [//params yang dikirim saat get,dan hanya ada di params
               'apikey'=>'generatekey1',//apikey
               'id'=>$id// params id dengan value $id
           ]
       ]);

       $result = json_decode($response->getBody()->getContents(),true);//decode json menjadi array disimpan ke $result
       return $result['data'][0];//kembalikan $result yang di dalamnya ada array data, dengan index 0, karna hanya 1 data yang mau diambil
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true),
            'apikey'=>'generatekey1'
        ];

        // $this->db->where('id', $this->input->post('id'));
        // $this->db->update('mahasiswa', $data);

        $response = $this->_client->request('PUT','mahasiswa',[ //request dengan methode PUT, ke controller mahasiswa, dengan form params
            'form_params'=> $data//form params isi dengan $data
        ]);

        $result = json_decode($response->getBody()->getContents(),true);//decode json menjadi array disimpan ke $result
        return $result;//kembalikan $result 
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}