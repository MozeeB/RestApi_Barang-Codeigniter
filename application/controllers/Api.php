<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {


	public function getBarang(){

        $data = $this->db->get("tb_barang");

        if($data -> num_rows() > 0){
            $response['status'] = true;
            $response['pesan'] = "Tampilkan barang successfully!";
            $response['barang'] = $data->result();
        }else{
            $response['status'] = false;
            $response['pesan'] = "Tampilkan barang failed!";
        }

        echo json_encode($response);
    }
    
    public function tambahBarang(){

        $nama_barang = $this->input->post('nama');
        $jenis_barang = $this->input->post('jenis');
        $harga = $this->input->post('harga');
        $stock = $this->input->post('stock');

        $insert = array();
        $insert['nama_barang'] = $nama_barang;
        $insert['jenis_barang'] = $jenis_barang;
        $insert['harga'] = $harga;
        $insert['stock'] = $stock;

        $simpan = $this->db->insert('tb_barang', $insert);
        if($simpan){
            $response['status'] = true;
            $response['pesan'] = "Tambah barang successfully";

        }else{
            $response['status'] = false;
            $response['pesan'] = "Tambah barang failed!";

        }
        echo json_encode($response);
    }

    public function updateBarang(){

        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $jenis = $this->input->post('jenis');
        $harga = $this->input->post('harga');
        $stock = $this->input->post('stock');

        $this->db->where('id', $id);
        $cek_id = $this->db->get('tb_barang');

        if($cek_id -> num_rows() == 0){
            $response['status'] = false;
            $response['pesan'] = "id tidak ditemukan!";
        }else{
            $this->db->where('id', $id);

            $update = array();
            $update['nama_barang'] = $nama;
            $update['jenis_barang'] = $jenis;
            $update['harga'] = $harga;
            $update['stock'] = $stock;

            $simpan = $this->db->update('tb_barang', $update);
            if($simpan){
                $response['status'] = true;
                $response['pesan'] = "Update successfully!";
            }else{
                $response['status'] = false;
                $response['pesan'] = "Update failed!";
            }
        }
        echo json_encode($response);
    }

    public function deleteBarang(){
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $cek_id = $this->db->get('tb_barang');

        if($cek_id -> num_rows() == 0){
            $response['status'] = false;
            $response['pesan'] = "id tidak ditemukan!";
        }else{
            $this->db->where('id',$id);
            $status = $this->db->delete('tb_barang');

            if($status){
                $response['status'] = true;
                $response['pesan'] = "Hapus successfully";
            }else{
                $response['status'] = false;
                $response['pesan'] = "Hapus failed";
            }
        }
        echo json_encode($response);
    }
  

}
