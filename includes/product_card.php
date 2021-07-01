<?php
function product_card($productTitle, $productPrice, $productImg, $productId, $productStars, $productBrand) {
    $starConfig = '';
    
    for ($i = 0; $i < 5; $i++) {
        if ($i < $productStars) {
            $starConfig .= "<i class=\"fas fa-star\"></i>";
        } else {
            $starConfig .= "<i class=\"far fa-star\"></i>";
        }
    }

    if (strlen($productTitle) > 33) {
        $productTitle = substr($productTitle, 0, 25) . '...';
    } else {
        $productTitle = substr($productTitle, 0, 28);
    }

    $element = "
        <div class=\"col-md-3 col-sm-6 my-3 my-md-0 mx-4 card-deck\">
            <form action=\"index.php\" method=\"post\">
                <div class=\"card card-block shadow p-2 my-2 br-20\">
                    <div>
                        <img src=\"$productImg\" alt=\"Product Image\" class=\"img-fluid card-img-top\" style=\"height: 175px;\">
                    </div>
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">$productTitle</h5>
                        <h6>
                            $starConfig 
                        </h6>
                        <p class=\"card-text\">
                            $productBrand
                        </p>
                        <h5>                                
                            <span class=\"price\">$productPrice TL</span>
                        </h5>

                        <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\"><i class=\"fas fa-shopping-cart\"></i></button>
                        <a href=\"product.php?product=$productId\" class=\"btn btn-warning my-3\"><i class=\"fas fa-eye\"></i></a>
                        <input type='hidden' name='product_id' value='$productId'>
                        <input type='hidden' name='product_price' value='$productPrice'>
                    </div>
                </div>
            </form>
        </div>";

    echo $element;
}

function cartElement($productImg, $productName, $productPrice, $productId, $productQuantity) {
    $element = "
        <form action=\"cart.php?action=remove&id=$productId\" method=\"post\" class=\"cart-items mb-3\">
            <div class=\"row bg-white border rounded\">
                <div class=\"col-md-3 pl-0 my-2\">
                    <img src=$productImg alt=\"Image1\" class=\"img-fluid\" style=\"height: 175px;\">
                </div>
                <div class=\"col-md-6\">
                    <h5 class=\"pt-2\">$productName</h5>                             
                    <h5 class=\"pt-2\">$productPrice TL</h5>                                
                    <button type=\"submit\" class=\"btn btn-danger\" name=\"remove\">Remove</button>
                </div>
                <div class=\"col-md-3 py-5\">
                    <a href=\"cart.php?action=minus&id=$productId\" type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></a>
                    <input type=\"text\" value=\"$productQuantity\" class=\"form-control w-25 d-inline\" readonly>
                    <a href=\"cart.php?action=plus&id=$productId\" type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></a>
                </div>
            </div>
        </form>
    ";

    echo $element;
}

function orderElement($productImg, $productName, $productPrice, $productId, $productQuantity) {
    $element = "
        <form action=\"cart.php?action=remove&id=$productId\" method=\"post\" class=\"cart-items my-3\">
            <div class=\"row bg-white border rounded mx-3\">
                <div class=\"col-md-3 pl-0 my-2\">
                    <img src=$productImg alt=\"Image1\" class=\"img-fluid\" style=\"height: 175px;\">
                </div>
                <div class=\"col-md-6\">
                    <h5 class=\"pt-2\">$productName</h5>                             
                    <h4 class=\"pt-2\">$productPrice TL</h4>
                </div>
                <div class=\"col-md-3 py-5\">
                    <input type=\"text\" value=\"$productQuantity\" class=\"form-control w-25 d-inline\" readonly>
                    <a href=\"product.php?product=$productId\" class=\"btn btn-warning mb-1\"><i class=\"fas fa-eye\"></i></a>
                    <a href=\"product.php?product=$productId\" class=\"btn btn-success mb-1\">Rate</a>
                </div>
            </div>
        </form>
    ";

    echo $element;
}
?>
