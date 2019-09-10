<?php

function convert_1_digits($number)
{
    $one_digits = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    return $one_digits[$number];
}
function convert_2_digits($number)
{
    $small_20s = [10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen'];
    $teens = [2 => 'twenty', 3 => 'thirty', 4 => 'forty', 5 => 'fifty', 6 => 'sixty', 7 => 'seventy', 8 => 'eighty', 9 => 'nicety'];
    if ($number < 20) {
        return $small_20s[$number];
    }
    if ($number[1] == 0) {
        return $teens[$number[0]];
    }
    return $teens[$number[0]] . ' ' . convert_1_digits($number[1]);
}
function convert_3_digits($number)
{
    if ($number % 100 == 0) {
        return convert_1_digits($number[0]) . ' ' . 'hundred';
    }
    if ($number[1] == 0) {
        return convert_1_digits($number[0]) . ' ' . 'hundred and' . ' ' . convert_1_digits($number[2]);
    }
    return convert_1_digits($number[0]) . ' ' . 'hundred' . ' ' . convert_2_digits(substr($number, 1, 2));
}
function convert_to_words($number)
{
    switch (strlen($number)) {
        case 1:
            $words = convert_1_digits($number);
            break;
        case 2:
            $words = convert_2_digits($number);
            break;
        case 3:
            $words = convert_3_digits($number);
            break;
        default:
            $words = 'out of ability';
            break;
    }
    return $words;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

<form method="post">
    <h2>Doc so thanh chu</h2>
    <label>Nhap so can doc: </label>
    <input type="number" name="number"/>

    <input type="submit"/>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $number = $_POST['number'];

    echo convert_to_words($number);
}
?>

</body>
</html>