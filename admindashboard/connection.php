<?php

    $link = new mysqli("localhost","root","","pitchar_project");
           if($link -> connect_errno > 0)
    {
        die ("Unable to connect to database : " . $link ->connect_error);
    }

?>