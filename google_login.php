<?php

// begin
if (isset($_GET['code'])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token['error'])){
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token']=$token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        $email=$data['email'];
        $firstname=$data['given_name'];
        $lastname=$data['family_name'];

        $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
            $token = str_shuffle($token);
        $token = substr($token, 0, 30);

        $qg="SELECT * FROM `users` WHERE `email`='$email'";
        $rg=mysqli_query($dbc,$qg);
        $numg=mysqli_num_rows($rg);

        if($numg==0){
            
            $q="INSERT INTO `users`(`firstname`, `lastname`, `email`, `token`, `active`) VALUES ('$firstname', '$lastname', '$email', '$token',1)";
            //echo $q; exit();
            $r=mysqli_query($dbc,$q);
            $last_id = mysqli_insert_id($dbc);
            
            $q0="SELECT * FROM `users` WHERE `id`='$last_id'";
            $r0=mysqli_query($dbc,$q0);
            $row0=mysqli_fetch_assoc($r0);

            if($row0['archived']==1){
                header('Location: login.php?archived');
                exit();
              }

            $_SESSION['user_id']=$row0['id'];
            $_SESSION['user_firstname']=$row0['firstname'];
            $_SESSION['user_lastname']=$row0['lastname'];
            $_SESSION['user_phone']=$row0['phone'];

            $_SESSION['user_bio']=$row0['bio'];
            $_SESSION['user_linkedin']=$row0['linkedin'];
            $_SESSION['user_twitter']=$row0['twitter'];
            $_SESSION['user_instagram']=$row0['instagram'];
            $_SESSION['user_facebook']=$row0['facebook'];

            $_SESSION['user_email']=$row0['email'];
            $_SESSION['ali_baba']=$row0['password'];
            $_SESSION['user_date']=$row0['date'];

            header('location: index.php');


        }else{
            $rowg=mysqli_fetch_assoc($rg);

            if($rowg['archived']==1){
                header('Location: login.php?archived');
                exit();
              }

            $_SESSION['user_id']=$rowg['id'];
            $_SESSION['user_firstname']=$rowg['firstname'];
            $_SESSION['user_lastname']=$rowg['lastname'];
            $_SESSION['user_phone']=$rowg['phone'];

            $_SESSION['user_bio']=$rowg['bio'];
            $_SESSION['user_linkedin']=$rowg['linkedin'];
            $_SESSION['user_twitter']=$rowg['twitter'];
            $_SESSION['user_instagram']=$rowg['instagram'];
            $_SESSION['user_facebook']=$rowg['facebook'];

            $_SESSION['user_email']=$rowg['email'];
            $_SESSION['ali_baba']=$rowg['password'];
            $_SESSION['user_date']=$rowg['date'];

            header('location: index.php');
        }

    }
}

// end

?>