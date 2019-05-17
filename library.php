<?php
class Library
{
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=peluit', 'root', '');
    }
    public function addMhs($npm, $nama, $ttl, $telp, $jurusan, $angkatan, $alamat, $email, $password)
    {
        $sql = "INSERT INTO mahasiswa (npm, nama, ttl, no_telepon, email, jurusan, angkatan, alamat) 
        VALUES ('$npm', '$nama', '$ttl', '$telp', '$email', '$jurusan', '$angkatan', '$alamat')";
        $query = $this->db->query($sql);

        $sql = "INSERT INTO akun (username, password) VALUES ('$npm', '$password')";
        $query = $this->db->query($sql);

        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
    public function editMhs($npm)
    {
        $sql = "SELECT * FROM mahasiswa WHERE npm='$npm'";
        $query = $this->db->query($sql);
        return $query;
    }
    public function updateMhs($kode, $judul, $pengarang, $penerbit)
    {
        $sql = "UPDATE books SET judulBuku='$judul', pengarang='$pengarang', penerbit='$penerbit' WHERE kodeBuku='$kode'";
        $query = $this->db->query($sql);
        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }

    public function showBooks()
    {
        $sql = "SELECT * FROM books";
        $query = $this->db->query($sql);
        return $query;
    }
    public function deleteBook($kode)
    {
        $sql = "DELETE FROM books WHERE kodeBuku='$kode'";
        $query = $this->db->query($sql);
    }
}
