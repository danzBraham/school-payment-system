<?php
class Kelas_model {
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getAllKelas() {
    $this->db->query("SELECT * FROM tb_kelas ORDER BY id_kelas ASC");
    return $this->db->results();
  }

  public function getKelasById($id) {
    $this->db->query("SELECT * FROM tb_kelas WHERE id_kelas = :id");
    $this->db->bind('id', $id);
    return $this->db->result();
  }

  public function getKelas() {
    $this->db->query("SELECT * FROM tb_kelas GROUP BY kelas");
    return $this->db->results();
  }

  public function getJurusan() {
    $this->db->query("SELECT * FROM tb_kelas GROUP BY jurusan");
    return $this->db->results();
  }

  public function addKelas() {
    $id_kelas = $_POST['id_kelas'];
    $kelas = $_POST['kelas'];
    $jurusan = $_POST['jurusan'];

    $this->db->query("INSERT INTO tb_kelas VALUES (
      :id_kelas, :kelas, :jurusan
    )");
    $this->db->bind('id_kelas', $id_kelas);
    $this->db->bind('kelas', $kelas);
    $this->db->bind('jurusan', $jurusan);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function updateKelas($data) {
    $idKelas = $data['id_kelas'];
    $kelas = $data['kelas'];
    $jurusan = $data['jurusan'];

    $this->db->query("UPDATE tb_kelas SET
                      kelas = :kelas,
                      jurusan = :jurusan
                      WHERE id_kelas = :id_kelas");
  
    $this->db->bind('id_kelas', $idKelas);
    $this->db->bind('kelas', $kelas);
    $this->db->bind('jurusan', $jurusan);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function deleteKelas($id) {
    $this->db->query("DELETE FROM tb_kelas WHERE id_kelas = :id");
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }
}