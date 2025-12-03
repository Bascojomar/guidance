<?php 

require 'function.php';
$uri = $_SERVER['REQUEST_URI'];

if($uri === '/'){
     require 'controller/login.php';
}else if($uri === '/register'){
     require 'controller/register.php';
}else if($uri === '/logout'){
     require 'controller/logout.php';
}else if($uri === '/dashboard'){
     require 'controller/dashboard.php';
}else if($uri === '/appointment'){
     require 'controller/appointment.php';
}else if($uri === '/conduct'){
     require 'controller/conduct.php';
}else if($uri === '/case'){
     require 'controller/case.php';
}else if($uri === '/report'){
     require 'controller/report.php';
}else if($uri === '/sessionNotes'){
     require 'controller/sessionNotes.php';
}else if($uri === '/studentApp'){
     require 'controller/studentApp.php';
}else if($uri === '/appoint'){
     require 'controller/appoint.php';
}else if($uri === '/all_app'){
     require 'controller/all_app.php';
}else if($uri === '/manage_user'){
     require 'controller/manage_user.php';
}