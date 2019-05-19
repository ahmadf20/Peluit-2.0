<?php
class Library
{
    public function __construct()
    {
        try {    
            //create PDO connection 
            $this->db = new PDO('mysql:host=localhost;dbname=peluit', 'root', '');
        } catch(PDOException $e) {
            //show error
            die("Terjadi masalah: " . $e->getMessage());
        }
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
    public function addKandidat($noUrut, $NPM, $visi, $misi)
    {
        $sql = "INSERT INTO kandidat (NO_URUT, NPM, VISI, MISI) 
        VALUES ('$noUrut', '$NPM', '$visi', '$misi')";
        $query = $this->db->query($sql);

        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
    public function addTPS($kodeTPS, $lokasiTPS)
    {
        $sql = "INSERT INTO tps (Kode_TPS, Lokasi) 
        VALUES ('$kodeTPS', '$lokasiTPS')";
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
    public function editTPS($kodeTPS)
    {
        $sql = "SELECT * FROM tps WHERE Kode_TPS='$kodeTPS'";
        $query = $this->db->query($sql);
        return $query;
    }
    public function editKandidat($NPM)
    {
        $sql = "SELECT * FROM kandidat WHERE NPM='$NPM'";
        $query = $this->db->query($sql);
        return $query;
    }
    public function updateMhs($npm, $nama, $ttl, $telp, $jurusan, $angkatan, $alamat, $email, $password)
    {
        $sql = "UPDATE mahasiswa SET npm='$npm', nama='$nama', ttl='$ttl', no_telepon='$telp', email='$email', jurusan='$jurusan', angkatan='$angkatan', alamat='$alamat' WHERE npm='$npm'";
        $query = $this->db->query($sql);
        
        $sql = "UPDATE Akun SET Username='$npm', Akun.password='$password' WHERE Username='$npm'";
        $query = $this->db->query($sql);
        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
    public function updateTPS($kodeTPS, $lokasiTPS, $kodeBefore)
    {
        $sql = "UPDATE tps SET Kode_TPS='$kodeTPS', Lokasi='$lokasiTPS' WHERE Kode_TPS='$kodeBefore'";
        $query = $this->db->query($sql);
        
        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
    public function updateKandidat($NPM, $noUrut, $visi, $misi, $NPMbefore)
    {
        $sql = "UPDATE kandidat SET NPM='$NPM', NO_URUT='$noUrut', VISI='$visi', MISI='$misi' WHERE  NPM='$NPMbefore'";
        $query = $this->db->query($sql);
        
        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
    public function showMhsNoVerif()
    {
        $sql = "SELECT * FROM mahasiswa WHERE validasi=0";
        $query = $this->db->query($sql);
        return $query;
    }
    public function showSuara()
    {
        $sql = "SELECT * FROM voting";
        $query = $this->db->query($sql);
        return $query;
    }
    public function showKandidatVote()
    {
        $sql = "SELECT * FROM kandidat";
        $query = $this->db->query($sql);
        return $query;
    }
    public function showMhsVerif()
    {
        $sql = "SELECT * FROM mahasiswa WHERE validasi=1";
        $query = $this->db->query($sql);
        return $query;
    }
    public function showTPS()
    {
        $sql = "SELECT * FROM tps";
        $query = $this->db->query($sql);
        return $query;
    }
    public function showKandidat()
    {
        $sql = "SELECT * FROM kandidat";
        $query = $this->db->query($sql);
        return $query;
    }
    public function showPerson($npm)
    {
        $sql = "SELECT * FROM mahasiswa WHERE  npm='$npm'";
        $query = $this->db->query($sql);
        return $query;
    }
    public function deleteMhs($npm)
    {
        $sql = "DELETE FROM akun WHERE USERNAME='$npm'";
        $query = $this->db->query($sql);

        $sql = "DELETE FROM mahasiswa WHERE NPM='$npm'";
        $query = $this->db->query($sql);
        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
    public function deleteTPS($kodeTPS)
    {
        $sql = "DELETE FROM tps WHERE Kode_TPS='$kodeTPS'";
        $query = $this->db->query($sql);

        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
    public function deleteKandidat($NPM)
    {
        $sql = "DELETE FROM kandidat WHERE NPM='$NPM'";
        $query = $this->db->query($sql);

        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
    public function validasiMhs($npm)
    {
        $sql = "UPDATE mahasiswa SET Validasi=1 WHERE npm='$npm'";
        $query = $this->db->query($sql);
        
        if (!$query) {
            return "Failed";
        } else {
            return "Success";
        }
    }
}


