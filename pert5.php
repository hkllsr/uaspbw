<?php
    $data_mahasiswa = "Haikal";
    $data_saya = "Lucy";
    $pekerjaan = "Petani";

    if($data_mahasiswa =="Haikal"){
        if($pekerjaan =="Petani"){
            $jenis_kelamin ="Laki-Laki";
            $penghasilan_perbulan =1900000;
        }else{
            $jenis_kelamin ="Laki-Laki";
            $penghasilan_perbulan =1000000;
        }
        }else if($data_saya == "Lucy"){
            $jenis_kelamin="Perempuan";
        }else{
            $jenis_kelamin ="??";
        }

    echo "Halo ".$data_mahasiswa."! Saya ".$data_saya. "!".
    "Selamat datang di web saya. Jenis Kelamin kamu adalah ".$jenis_kelamin.",penghasilan anda : ".$penghasilan_perbulan;
?>