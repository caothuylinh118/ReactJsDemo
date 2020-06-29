<?php
if(!empty($error_msg)){
    echo '<p class="error">'.$error_msg.'</p>';
}
?>

<?php
if(!empty($userData)){
    $outputHTML = '
        <div class="wrapper">
            <h1>Twitter Profile Details </h1>
            <div class="welcome_txt">Welcome <b>'.$userData['first_name'].'</b></div>
            <div class="tw_box">
                <p class="image"><img src="'.$userData['picture_url'].'" alt="" width="300" height="220"/></p>
                <p><b>Twitter Username : </b>'.$userData['username'].'</p>
                <p><b>Name : </b>'.$userData['first_name'].' '.$userData['last_name'].'</p>
                <p><b>Locale : </b>' . $userData['locale'].'</p>
                <p><b>Twitter Profile Link : </b><a href="'.$userData['profile_url'].'" target="_blank">'.$userData['profile_url'].'</a></p>
                <p><b>You are login with : </b>Twitter</p>
                <p><b>Logout from <a href="'.base_url().'user_authentication/logout">Twitter</a></b></p>';
    //Latest tweets
    if(!empty($tweets)){
        $outputHTML .= '<div class="tweetList"><strong>Latest Tweets : </strong>
            <ul>';
        foreach($tweets  as $tweet){
            $outputHTML .= '<li>'.$tweet->text.' <br />-<i>'.$tweet->created_at.'</i></li>';
        }
        $outputHTML .= '</ul></div>';
    }
    $outputHTML .= '</div>
        </div>';
}else{
    $outputHTML = '<a href="'.$oauthURL.'">Tay</a>';
}
?>
<?php echo $outputHTML; ?>
