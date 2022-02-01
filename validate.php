<?php

if($_POST['a'] == !'' && $_POST['b'] == !'' && $_POST['c'] == !'') {
    
    echo 0;
    
} elseif($_POST['a'] == !'' && $_POST['c'] == !'') {
    
    echo 1;
    
} elseif($_POST['a'] == '' && $_POST['b'] == '' && $_POST['c'] == '') {
    
    echo 2;
    
} elseif($_POST['a'] == '' || $_POST['c'] == '') {
    
    echo 3;
    
}