<?php
session_start();
include 'connection.php';
date_default_timezone_set('Asia/Kolkata');
$userscard = "";
$count = 0;
$sql = "SELECT * FROM tbl_users ORDER BY fullname";
if($result = $link ->query($sql))
{
    while($rows = $result->fetch_array(MYSQLI_ASSOC))
    {
        $name = $rows['fullname'];
        $occupation = $rows['occupation'];
        $email = $rows['email'];
        $country = $rows['country'];
        $user_type = $rows['user_type'];
        $verified = $rows['verify'];                                                                                          
        $usercards .="<div class='card'>
    <div class='card-header blue lighten-3 z-depth-1' role='tab' id='heading".$count."'>
      <h5 class='text-uppercase mb-0 py-1'>
        <a class='white-text font-weight-bold ' data-toggle='collapse' href='#collapse".$count."' aria-expanded='true'
          aria-controls='collapse".$count."'>
          $email($name)
        </a>
      </h5>
    </div>
    <div id='collapse".$count."' class='collapse' role='tabpanel' aria-labelledby='heading".$count."'
      data-parent='#accordionEx23'>
      <div class='card-body'>
      <div class='row my-4'>
      <div class='col-md-8'>
        <h2 class='font-weight-bold mb-3 black-text'>$name</h2>
        <div class='row'>
    <div class='col-sm-12'>
    <div class='single category'>
    <h3 class='side-title'>Profile</h3>
    <ul class='list-unstyled'>
        <li style = 'text-transform: uppercase;'><a href='' title=''>NAME: <span class='pull-right'>$name</span></a></li>
        <li><a href='' title=''>OCCUPATION:<span class='pull-right'>$occupation</span></a></li>
        <li><a href='' title=''>EMAIL:<span class='pull-right'>$email</span></a></li>
        <li style = 'text-transform: uppercase;'><a href='' title=''>COUNTRY: <span class='pull-right'>$country</span></a></li>
        <li style = 'text-transform: uppercase;'><a href='' title=''>USER TYPE: <span class='pull-right'>$user_type</span></a></li>
        <li style = 'text-transform: uppercase;'><a href='' title=''>USER VERIFIED: <span class='pull-right'>$verified</span></a></li>
    </ul>
</div>
</div> 
</div>
      </div>

    </div>
  </div>
</div>
</div>";
$count++;
    }

}

echo "<div class='container-fluid'>
<div class='accordion md-accordion accordion-1' id='accordionEx23' role='tablist'>
  $usercards
</div>
        </div>";
?>

