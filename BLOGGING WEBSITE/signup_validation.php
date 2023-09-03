<?php

// check firstname
if(empty($firstname)){
    $error['firstname'] = 'firstname cannot be empty';
} else{
    if(!preg_match('/^[a-zA-Z\s]+$/', $firstname)){
        $error['firstname'] = 'firstname must be letters only';
    }
}

// check surname
if(empty($surname)){
    $error['surname'] = 'surname cannot be empty';
} else{
    if(!preg_match('/^[a-zA-Z\s]+$/', $surname)){
        $error['surname'] = 'surname must be letters only';
    }
}


// check username
if(empty($username)){
    $error['username'] = 'username cannot be empty';
} else{
    if(!preg_match('/^[a-zA-Z\s]+$/', $username)){
        $error['username'] = 'username must be letters only';
    }
}



// check email
if(empty($email)){
    $error['email'] = 'email cannot be empty';
} else{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error['email'] = 'email must be a valid email';
    }
}

// check password
if(empty($password)){
    $error['password'] = 'password cannot be empty';
} else{
    if(!preg_match('/^[a-zA-Z0-9]{6,10}$/', $password)){
        $error['password'] = 'password must be 6-10 chars and alphanumeric';
    }
}

// check confirm password
if(empty($cpassword)){
    $error['cpassword'] = 'confirm password cannot be empty';
} else{
    if ($cpassword !== $password){
        $error['cpassword'] = 'passwords does not match';
    }
}

// check confirm password
if(empty($profilepics)){
    $error['profilepics'] = 'You must choose a photo';
}

?>