<?php
if(isset($_POST['InputName'], $_POST['InputEmail'], $_POST['InputMessage'], $_POST['InputReal'])){
    if($_POST['InputReal'] == 7){
        $to = 'slav.slavchev.98@gmail.com';
        $from = $_POST['InputEmail'];
        $subject = 'SEAWORLD';
        $message = $_POST['InputMessage'];

        mail($to, $subject, $message, "From : " . $from);
    }
}
    
?> 