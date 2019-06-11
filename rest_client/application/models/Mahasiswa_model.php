<?php 
use GuzzleHttp\Client;//namespace guzzle
class Mahasiswa_model extends CI_model {
    public function getAllMahasiswa()
    {
        //return $this->db->get('mahasiswa')->result_array();
        $client= new Client();//instansiasi Client
         $response = $client->request('GET','http://localhost/rest_api/rest_server/api/mahasiswa',[//request methode get dengan link http localhost/....
             'auth'=>['admin','1234'],//parameter auth [admin,password]
             'query' => [//params yang dikirim saat get
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
            "jurusan" => $this->input->post('jurusan', true)
        ];

        $this->db->insert('mahasiswa', $data);
    }

    public function hapusDataMahasiswa($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('mahasiswa', ['id' => $id]);
    }

    public function getMahasiswaById($id)
    {
        return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true)
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('mahasiswa', $data);
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