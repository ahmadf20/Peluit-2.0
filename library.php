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
    public function updateMhs($npm, $nama, $ttl, $telp, $jurusan, $angkatan, $alamat, $email, $password)
    {
        $sql = "UPDATE mahasiswa SET npm='$npm', nama='$nama', ttl='$ttl', no_telepon='$telp', email='$email', jurusan='$jurusan', angkatan='$angkatan', alamat='$alamat' WHERE npm='$npm'";
        $query = $this->db->query($sql);
        
        $sql = "UPDATE Akun SET Username='$npm', Akun.password=:'$password' WHERE Username='$npm'";
        $query = $this->db->query($sql);
        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
    public function showMhs()
    {
        $sql = "SELECT * FROM mahasiswa";
        $query = $this->db->query($sql);
        return $query;
    }
    public function deleteMhs($npm)
    {
        $sql = "DELETE FROM akun WHERE username='$npm'";
        $query = $this->db->query($sql);

        $sql = "DELETE FROM mahasiswa WHERE npm='$npm'";
        $query = $this->db->query($sql);
        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
}
