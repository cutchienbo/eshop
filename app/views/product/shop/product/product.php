<?php
$data['manufactorers'] = array(
    'Zara',
    'H&M',
    'Gucci',
    'Nike',
    'Adidas',
    'Channel'
);
// echo '<pre>';
// print_r($data);
// echo '</pre>';

?>

<section class="product-area shop-sidebar shop section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="shop-sidebar">

                    <div class="single-widget category">
                        <h3 class="title">Categories</h3>
                        <ul class="categor-list">

                            <?php foreach ($data['product_type'] as $key => $value) { ?>

                                <li>
                                    <a class="product-type" href=<?php echo _WEB_ROOT . '/product' . '/' . $data['pagination'] . '/' . $value['id'] ?>>
                                        <?php echo ucfirst($value['name_type']) ?>
                                    </a>
                                </li>

                            <?php } ?>


                        </ul>
                    </div>

                    <div class="single-widget recent-post">
                        <h3 class="title">Recent post</h3>

                        <?php
                        if (!isset($data['recent_post'])) {
                            $data['recent_post'] = [];
                        }
                        foreach ($data['recent_post'] as $key => $value) { ?>

                            <div class="single-post first">
                                <div class="image">
                                    <img src=<?php echo $value['id_image'][0] ?> alt="#">
                                </div>
                                <div class="content">
                                    <h5>
                                        <a href=<?php echo _WEB_ROOT.'/item-'.$value['id'] ?>>
                                            <?php echo $this->view->name_upper($value['name']) ?>
                                        </a>
                                    </h5>
                                    <p class="price">
                                        <?php
                                        if (!empty($value['discount'])) {
                                            echo '<span class="discount">' .
                                                '$' . ($value['cost'] * (100 - $value['discount']) / 100) . ' 
                                            </span>';
                                            echo '<s>' . '$' . $value['cost']  . '</s>';
                                        } else {
                                            echo '$' . $value['cost'];
                                        }
                                        ?>
                                    </p>
                                    <ul class="reviews">

                                        <?php for ($j = 0; $j < 5; $j++) { ?>

                                            <li class=<?php echo $j < $value['star'] ? 'yellow' : '' ?>>
                                                <i class="ti-star"></i>
                                            </li>

                                        <?php } ?>

                                    </ul>
                                </div>
                            </div>

                        <?php } ?>

                    </div>

                    <div class="single-widget category">
                        <h3 class="title">Manufacturers</h3>
                        <ul class="categor-list">

                            <?php foreach ($data['manufactorers'] as $key => $value) { ?>

                                <li>
                                    <a href="#">
                                        <?php echo $value ?>
                                    </a>
                                </li>

                            <?php } ?>

                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-12">
                <div class="row">
                    <div class="col-12">

                        <div class="shop-top">
                            <div class="shop-shorter">
                                <form method="post">
                                    <div class="single-shorter">
                                        <label>Name :</label>
                                        <select name="name">
                                            <option value="">none</option>
                                            <option value="ASC" <?php
                                                                if (isset($_POST['name'])) {
                                                                    echo $_POST['name'] == 'ASC' ? 'selected' : '';
                                                                }
                                                                ?>>
                                                a - z
                                            </option>
                                            <option value="DESC" <?php
                                                                    if (isset($_POST['name'])) {
                                                                        echo $_POST['name'] == 'DESC' ? 'selected' : '';
                                                                    }
                                                                    ?>>
                                                z - a
                                            </option>
                                        </select>
                                    </div>
                                    <div class="single-shorter">
                                        <label>Price :</label>
                                        <select name="price">
                                            <option value="">none</option>
                                            <option value="ASC" <?php
                                                                if (isset($_POST['price'])) {
                                                                    echo $_POST['price'] == 'ASC' ? 'selected' : '';
                                                                }
                                                                ?>>
                                                low to high
                                            </option>
                                            <option value="DESC" <?php
                                                                    if (isset($_POST['price'])) {
                                                                        echo $_POST['price'] == 'DESC' ? 'selected' : '';
                                                                    }
                                                                    ?>>
                                                high to low
                                            </option>
                                        </select>
                                    </div>
                                    <div class="single-shorter">
                                        <input type="submit" value="Sort">
                                    </div>
                                </form>
                            </div>


                            <?php if ($data['count_product_list'] > 1) { ?>

                                <div class="pagination">

                                    <a class="button" href=<?php echo _WEB_ROOT . '/product' . '/' . $data['pagination_path'] . '1' ?>>
                                        <i class="ti-angle-double-left"></i>
                                    </a>

                                    <a class="button" href=<?php echo _WEB_ROOT . '/product' . '/' . $data['pagination_path'] . $data['prev'] ?>>
                                        <i class="ti-angle-left"></i>
                                    </a>

                                    <?php for ($i = $data['pagination_start']; $i <= $data['pagination_end']; $i += 1) { ?>

                                        <a class="tab <?php echo $i == $data['pagination'] ? 'active' : '' ?>" href=<?php echo _WEB_ROOT . '/product' . '/' . $data['pagination_path'] . $i ?>>
                                            <?php echo $i ?>
                                        </a>

                                    <?php } ?>

                                    <a class="button" href=<?php echo _WEB_ROOT . '/product' . '/' . $data['pagination_path'] . $data['next'] ?>>
                                        <i class="ti-angle-right"></i>
                                    </a>

                                    <a class="button" href=<?php echo _WEB_ROOT . '/product' . '/' . $data['pagination_path'] . $data['count_product_list'] ?>>
                                        <i class="ti-angle-double-right"></i>
                                    </a>

                                </div>

                            <?php } ?>

                        </div>

                    </div>
                </div>
                <div class="row">

                    <?php

                    foreach ($data['product_list'] as $key => $value) {
                    ?>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href=<?php echo _WEB_ROOT . '/item-' . $value['id'] ?>>
                                        <img class="default-img" src=<?php echo $value['id_image'][0]['id_image'] ?> alt="#">
                                        <img class="hover-img" src=<?php
                                                                    $index = 1;
                                                                    if (!isset($value['id_image'][1])) {
                                                                        $index = 0;
                                                                    }
                                                                    echo $value['id_image'][$index]['id_image'];
                                                                    ?> alt="#">
                                    </a>
                                    <div class="button-head">
                                        <div class="product-action">
                                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                                            <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                                        </div>
                                        <div class="product-action-2">
                                            <a title="Add to cart" href=<?php echo _WEB_ROOT . '/item-' . $value['id'] ?>>Detail product</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h3>
                                        <a href=<?php echo _WEB_ROOT . '/item-' . $value['id'] ?>>
                                            <?php echo $this->view->name_upper($value['name']) ?>
                                        </a>
                                    </h3>
                                    <div class="product-price">
                                        <p class="price">
                                            <?php
                                            if (!empty($value['discount'])) {
                                                echo '<span class="discount">' .
                                                    '$' . ($value['cost'] * (100 - $value['discount']) / 100) . ' 
                                            </span>';
                                                echo '<s>' . '$' . $value['cost']  . '</s>';
                                            } else {
                                                echo '<span>$' . $value['cost'] . '</span>';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>