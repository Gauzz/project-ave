<?php 

$conn=mysqli_connect("localhost","pitchar_project","111444777aaa@@@","pitchar_project");

/* Random string
	Example to use
	$a = token(32);
	$b = token(8, 'abcdefghijklmnopqrstuvwxyz');
*/

function token($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}



/* Random int
	Example to use
	$a = token(32);
	$b = token(8, 'abcdefghijklmnopqrstuvwxyz');
*/



function tokenInt($length, $keyspace = '0123456789')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
 ?>