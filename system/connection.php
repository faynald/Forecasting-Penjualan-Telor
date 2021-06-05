<?php

$connection = mysqli_connect("localhost", "root", "", "forecasting");
if (mysqli_connect_errno()) {
    echo mysqli_connect_errno();
}
