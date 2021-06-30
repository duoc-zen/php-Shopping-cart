<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="./resource/css/bootstrap.min.css">
</head>

<body>

    <div class=" container-fluid">
        <div class=" row">
            <div class=" col mt-3">
                <div class=" card shadow-sm p-3 mb-3 bg-body rounded">
                    <h3>Gio do</h3>
                    <div>
                        <table class="table">
                            <thead>
                                <th>ID</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="cart">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class=" col mt-3">
                <div class=" card shadow-sm p-3 mb-3 bg-body rounded">
                    <h3>Hoa don</h3>
                    <div>
                        <table class="table">
                            <thead>
                                <th>Amount</th>
                                <th>Total</th>
                            </thead>
                            <tbody id="bill">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class=" row">
            <div class=" col-5 m-auto">
                <div class=" card shadow-sm p-3 mb-3 bg-body rounded">
                    <h3 class=" mb-3">Them san pham</h3>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="productid" placeholder="Ma san pham">
                        <label for="productid">Ma san pham</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="price" placeholder="Gia">
                        <label for="price">Gia</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="amount" placeholder="so luong">
                        <label for="amount">so luong</label>
                    </div>
                    <input id="AddCart" class=" btn btn-outline-primary" type="submit" value="Them vao gio" />
                </div>
            </div>
        </div>


        <script src="./resource/js/jquery-3.6.0.min.js"></script>
        <script src="./resource/js/bootstrap.bundle.min.js"></script>
        <script>
            function view() {
                $.post("code_cart.php", {
                        action: "ViewCart",
                    },
                    function(data, status) {
                        $("#cart").html(data);
                    }
                );
                $.post("code_cart.php", {
                        action: "ViewBill",
                    },
                    function(data, status) {
                        $("#bill").html(data);
                    }
                );
            }

            function remove(id) {
                var rs = confirm("Ban muon go bo san pham nay ?");
                if (rs) {
                    $.post("code_cart.php", {
                            action: "RemoveCart",
                            id: id
                        },
                        function(data, status) {
                            alert(data);
                            view();
                        }
                    );
                }
            }

            function up(id) {
                $.post("code_cart.php", {
                        action: "UpCart",
                        id: id
                    },
                    function(data, status) {
                        view();
                    }
                );
            }

            function down(id) {
                $.post("code_cart.php", {
                        action: "DownCart",
                        id: id
                    },
                    function(data, status) {
                        view();
                    }
                );
            }

            $(document).ready(function() {

                view();

                $("#AddCart").click(function() {

                    var id = $("#productid").val();
                    var price = $("#price").val();
                    var amount = $("#amount").val();

                    $.post("code_cart.php", {
                            action: "AddCart",
                            id: id,
                            price: price,
                            amount: amount
                        },
                        function(data, status) {
                            alert(data);
                            view();
                            $("#productid").val("");
                            $("#price").val("");
                            $("#amount").val("");
                        }
                    );
                });

            });
        </script>
</body>

</html>