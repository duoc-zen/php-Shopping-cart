<?php
session_start();

if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "AddCart":
            AddCart();
            break;
        case "RemoveCart":
            RemoveCart();
            break;
        case "ViewCart":
            ViewCart();
            break;
        case "ViewBill":
            ViewBill();
            break;
        case "UpCart":
            UpCart();
            break;
        case "DownCart":
            DownCart();
            break;
    }
}

function AddCart()
{
    $id = $_POST["id"];
    $price = $_POST["price"];
    $amount = $_POST["amount"];
    $item = array($id, $price, $amount);

    if (!isset($_SESSION["cart"])) {
        $cart = array($item);
        $_SESSION["cart"] = $cart;
    } else {
        $cart = (array) $_SESSION["cart"];
        array_push($cart, $item);
        $_SESSION["cart"] = $cart;
    }
    echo "Thanh Cong !";
}

function RemoveCart()
{
    $id = $_POST["id"];
    if (isset($_SESSION["cart"])) {

        $cart = (array) $_SESSION["cart"];

        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i][0] == $id) {
                array_splice($cart, $i, 1);
            }
        }
        $_SESSION["cart"] = $cart;
    }
    echo "Thanh cong";
}

function UpCart()
{
    $id = $_POST["id"];
    if (isset($_SESSION["cart"])) {

        $cart = (array) $_SESSION["cart"];

        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i][0] == $id) {
                $cart[$i][2]++;
                break;
            }
        }
        $_SESSION["cart"] = $cart;
    }
}

function DownCart()
{
    $id = $_POST["id"];
    if (isset($_SESSION["cart"])) {

        $cart = (array) $_SESSION["cart"];

        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i][0] == $id) {
                $cart[$i][2]--;
                if ($cart[$i][2] <= 0) $cart[$i][2]=1;
                break;
            }
        }
        $_SESSION["cart"] = $cart;
    }
}

function ViewCart()
{
    if (isset($_SESSION["cart"]))
        foreach ($_SESSION["cart"] as $i) {
            echo "<tr>";
            echo "<td>$i[0]</td>";
            echo "<td>$i[1]</td>";
            echo "<td>$i[2]</td>";
            echo "<td><input class='btn btn-primary ms-3' type='button' onclick=remove('$i[0]') value='Remove' /><input class='btn btn-info ms-3' type='button' onclick=up('$i[0]') value='+' /><input class='btn btn-danger ms-3' type='button' onclick=down('$i[0]') value='-' /></td>";
            echo "</tr>";
        }
}

function ViewBill()
{
    $sum = 0;
    $amount = 0;
    if (isset($_SESSION["cart"]))
        foreach ($_SESSION["cart"] as $i) {
            $sum += $i[1] * $i[2];
            $amount += $i[2];
        }
    echo "<tr>";
    echo "<td>$amount</td>";
    echo "<td>$sum</td>";
    echo "</tr>";
}
