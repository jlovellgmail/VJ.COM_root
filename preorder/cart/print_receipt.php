<?php
$rootpath = $_SERVER['DOCUMENT_ROOT'];

require_once $rootpath . "/classes/Order.class.php";
require_once $rootpath . "/classes/Product.class.php";
require_once $rootpath . "/classes/Address.class.php";
require_once $rootpath . "/core/Countries.class.php";
require_once $rootpath . "/classes/CreditCard.class.php";

$orderExist = FALSE;
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_SESSION["Order"])) {
    $Order = $_SESSION["Order"];
    if ($Order->count() > 0) {
        $orderExist = TRUE;
    }
}

$Countries = new Countries();
?>

<html class="no-js" lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Order Received | Virgil James</title>
        <style>
            body {
                font: 14px/1.4 Helvetica, Arial, sans-serif;
            }
            #page-wrap {
                max-width: 800px;
                margin: 16px auto;
                padding:8px;
            }
            table {
                border-collapse: collapse;
                width:100%;
            }

            table.customer-info > tbody > tr > td ,
            table.customer-info > thead > tr > th { font-style:italic; border:1px solid #ccc; padding:10px;}

            table.customer-info > tbody > tr > td > table > tbody > tr > td,
            table.customer-info > tbody > tr > td > table > thead > tr > th { padding-bottom:6px; }

            table td, table th {
                border: 1px solid #ccc;
                padding: 5px;
            }
            table.inner td, table.inner th {
                border:none;
                padding:0;
            }
            table th {
                padding:5px;
                color:#000;
            }
            .left {
                text-align:left;
            }
            .center {
                text-align:center;
            }
            .right {
                text-align:right;
            }
            table.inner tr td {
                vertical-align:top!important;
                text-align:left;
            }
            table.inner tr td.item-name-info {
                width:60%;
                color:#333;
            }
            table.inner tr td.item-name-info p {
                margin:5px 0;
            }
            table.inner tr td.item-detail-info {
                text-align:right;
                width:40%;
                font-style:italic;
                color:#333;
            }
            table.inner tr td.item-detail-info p {
                margin:5px 0;
            }
            table.customer-info {
                margin-bottom:20px;
            }
            table.customer-info td, table.customer-info th {
                border: none;
                padding:0px;
            }
            tr.v-top td {
                vertical-align:top;
            }
            tr.v-mid td {
                vertical-align:middle;
            }
            tr.v-bot td {
                vertical-align:bottom;
            }
            td.no-bord {
                border:none !important;
            }
            tr.no-bord td {
                border:none !important;
            }
            td.no-bord-b { border-bottom:none !important; }
            td.no-bord-t { border-top:none !important; }
            td.no-bord-r { border-left:none !important; }
            td.no-bord-l { border-right:none !important; }

            .bold { font-weight:bold; }
            .italic { font-style:italic; }

            tr.total-rows td {
                border:none;
                text-transform:uppercase;
            }
            tr.total-rows.first td {
                padding-top:20px;
            }

            td.logo{ padding-bottom:30px; padding-left:0;}

            .pad-t-5{padding-top:5px;}.pad-t-10{padding-top:10px;}.pad-t-15{padding-top:15px;}

            tr.pad-t-15 td{padding-top:15px;}

        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    </head>
    <body class="cartBody">

        <?php include 'incs/print_receipt.php'; ?>

        <script>
            $(document).ready(function () {
                window.print();
            });
        </script>


    </body>
</html>