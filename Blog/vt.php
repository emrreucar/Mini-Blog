<?php

    $baglanti = new mysqli ('localhost', 'root', '', 'emredbblog');
        if(mysqli_connect_error()) // !Eğer hata varsa
        {
            echo mysqli_connect_error();
            exit; // !Eğer hata varsa PHP çalışmasını sonlandırıyoruz.
        }
        else{
            //echo 'Baglantı tamam';
        }
        
        $baglanti -> set_charset('utf8');

        


?>