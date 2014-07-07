<!DOCTYPE html>
<html>
<body>

<?php
$str = "Hello world. It's a beautiful day.";
print_r (explode(" ",$str,-2));

$a = array(
    "one" => 1,
    "two" => 2,
    "three" => 3,
    "seventeen" => 17
);

foreach ($a as $k => $v) {
    echo "\n\$a[$k] => $v.\n";
}

?>  

</body>
</html>