<?php 
// Temporary test code - put this in a separate test file
$plainPassword = "wasikaran";
$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

if (password_verify($plainPassword, '$2y$10$0fxCTGXELPJHeTikCnVo..mSoo7oOiXPsoEpFB6MqoF8htqzFgGki')) {
    echo "Password matches!";
} else {
    echo "Password DOES NOT match!";
}

$name = 'brainmaster816@gamil.com';
$namee = 'brainmaster816@gmail.com';
if($name === $namee){
    echo "success";
}else{
        echo "failed!";

}
?>