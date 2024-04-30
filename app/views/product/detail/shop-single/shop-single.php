<section class="shop single section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 col-12">

                        <div class="product-gallery">

                            <div class="flexslider-thumbnails">
                                <ul class="slides">

                                    <?php foreach ($data['product_image'] as $key => $value) { ?>

                                        <li data-thumb=<?php echo $value['id_image'] ?> rel=<?php echo !$key ? "adjustX:10, adjustY:" : "" ?>>
                                            <img src=<?php echo $value['id_image'] ?> loading="eager" alt="#">
                                        </li>

                                    <?php } ?>

                                </ul>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="product-des">

                            <div class="short">
                                <h4>
                                    <?php
                                    echo $this->view->name_upper($data['product']['name']);
                                    ?>
                                </h4>
                                <div class="rating-main">

                                    <ul class="rating product-rate">
                                        <li class="total-rating"><?php echo  $data['product']['star'] ?></li>
                                        <?php for ($j = 0; $j < 5; $j++) { ?>

                                            <?php if ($j < $data['product']['star'] && $j + 1 > $data['product']['star']) { ?>
                                                <li>
                                                    <i class="fa fa-star-half-o"></i>
                                                </li>
                                            <?php } else if ($data['product']['star'] > $j) { ?>
                                                <li>
                                                    <i class="fa fa-star"></i>
                                                </li>
                                            <?php } else { ?>
                                                <li>
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                            <?php } ?>


                                        <?php } ?>

                                    </ul>
                                    <a href="#" class="total-review">
                                        (<?php echo $data['product']['review'] ?>) Review
                                    </a>
                                </div>
                                <p class="price">
                                    <?php
                                    if (!empty($data['product_sale'])) {
                                        echo '<span class="discount">' .
                                            '$' . ($data['product']['cost'] * (100 - $data['product_sale']['discount']) / 100) . ' 
                                            </span>';
                                        echo '<s>' . '$' . $data['product']['cost']  . '</s>';
                                    } else {
                                        echo '<span>$' . $data['product']['cost'] . '</span>';
                                    }
                                    ?>
                                </p>
                                <p class="description">
                                    <?php echo $data['product']['content'] ?>
                                </p>
                            </div>


                            <form method="post" action=<?php echo _WEB_ROOT . '/add_item' . $_SERVER['PATH_INFO'] . '-' . $data['product']['quantity'] ?>>
                                <div class="color">
                                    <h4>Available Options <span>Color</span></h4>
                                    <ul>
                                        <?php
                                        foreach ($data['product_image'] as $key => $value) { ?>

                                            <li>
                                                <span style="background-color:#<?php echo $value['color'] ?>">
                                                    <i class="ti-check"></i>
                                                </span>
                                            </li>

                                        <?php } ?>

                                        <div style="display:none">
                                            <?php
                                            foreach ($data['product_image'] as $value) { ?>

                                                <input type="radio" name="color" value=<?php echo $value['color'] ?> required>

                                            <?php } ?>
                                        </div>


                                        <script>
                                            var colorList = document.querySelectorAll('.color li span');
                                            var inputColorList = document.querySelectorAll('.color input');
                                            var checkIcon = document.querySelectorAll('.color li span i')
                                            inputColorList[0].checked = true;
                                            checkIcon[0].style.visibility = 'visible';
                                            checkIcon[0].style.opacity = '1';

                                            colorList.forEach((item, key) => {
                                                item.onclick = () => {
                                                    inputColorList[key].checked = true;
                                                    checkIcon[key].style.visibility = 'visible';
                                                    checkIcon[key].style.opacity = '1';
                                                    colorList.forEach((value, i) => {
                                                        if (i != key) {
                                                            checkIcon[i].style.visibility = 'hidden';
                                                            checkIcon[i].style.opacity = '0';
                                                        }
                                                    })
                                                }
                                            })
                                        </script>

                                    </ul>
                                </div>

                                <div class="size">
                                    <h4>Size</h4>
                                    <ul>

                                        <?php
                                        foreach ($data['product_size'] as $key => $value) {
                                        ?>

                                            <li><span><?php echo $value ?></span></li>

                                        <?php } ?>

                                        <div style="display:none">
                                            <?php
                                            foreach ($data['product_size'] as $value) {
                                            ?>

                                                <input type="radio" name="size" value=<?php echo $value ?> required>

                                            <?php } ?>
                                        </div>

                                        <script>
                                            var sizeList = document.querySelectorAll('.size span');
                                            var inputSizeList = document.querySelectorAll('.size input');
                                            inputSizeList[0].checked = true;
                                            sizeList[0].style.border = '1px solid #F7941D';
                                            sizeList[0].style.color = '#F7941D';

                                            sizeList.forEach((item, key) => {
                                                item.onclick = () => {
                                                    inputSizeList[key].checked = true;
                                                    item.style.border = '1px solid #F7941D';
                                                    item.style.color = '#F7941D';
                                                    sizeList.forEach((value, i) => {
                                                        if (i != key) {
                                                            value.style.border = '1px solid #eee';
                                                            value.style.color = '#333';
                                                        }
                                                    })
                                                }
                                            })
                                        </script>

                                    </ul>
                                </div>

                                <div class="product-buy">
                                    <div class="quantity">
                                        <h6>Quantity :</h6>

                                        <div class="input-group">
                                            <div class="button minus">
                                                <button id="detail-quantity-minus" type="button" class="btn btn-primary btn-number">
                                                    <i class="ti-minus"></i>
                                                </button>
                                            </div>
                                            <input id="detail-quantity-input" type="number" name="detail_quantity" class="quantity-order" value="1">
                                            <div class="button plus">
                                                <button id="detail-quantity-plus" type="button" class="btn btn-primary btn-number">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <script>
                                            var buttonPlus = document.querySelector('#detail-quantity-plus');
                                            var buttonMinus = document.querySelector('#detail-quantity-minus');
                                            var quantityInput = document.querySelector('#detail-quantity-input');

                                            buttonMinus.onclick = () => {
                                                if (quantityInput.value > 1) {
                                                    quantityInput.value--;
                                                }
                                            }

                                            buttonPlus.onclick = () => {
                                                if (quantityInput.value < <?php echo $data['product']['quantity'] ?>) {
                                                    quantityInput.value++;
                                                }
                                            }



                                            quantityInput.oninput = () => {
                                                if (quantityInput.value > <?php echo $data['product']['quantity'] ?>) {
                                                    quantityInput.value = <?php echo $data['product']['quantity'] ?>
                                                }
                                                if (quantityInput.value < 1) {
                                                    quantityInput.value = "";
                                                    quantityInput.value = 1;
                                                }
                                            }
                                        </script>

                                    </div>
                                    <div class="add-to-cart">

                                        <?php if (isset($_SESSION['id_customer'])) { ?>
                                            <input type="submit" class="btn" value="Add to cart">
                                        <?php } else { ?>
                                            <a href=<?php echo _WEB_ROOT . $_SERVER['PATH_INFO'] . '/login' ?> class="btn">Add to cart</a>
                                        <?php } ?>

                                        <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                        <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                                    </div>
                                </div>
                            </form>


                            <p class="cat">
                                Category :
                                <a href=<?php echo _WEB_ROOT . '/product' . '/' . $data['product']['id_type'] ?>>
                                    <?php echo ucfirst($data['product']['name_type']) ?>
                                </a>
                            </p>
                            <p class="availability">Availability : <?php echo $data['product']['quantity'] ?> Products In Stock</p>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-info">

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                                    <div class="tab-single review-panel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="ratting-main">
                                                    <div class="avg-ratting">
                                                        <h4><?php echo $data['product']['star'] ?> <span>(Overall)</span></h4>
                                                        <span>Based on 1 Comments</span>
                                                    </div>

                                                    <div class="comment-list">
                                                        <?php 
                                                            foreach ($data['comment'] as $key => $value) { 
                                                                $active_comment = '';
                                                                if(isset($_SESSION['id_customer'])){
                                                                    if($_SESSION['id_customer']['id'] == $value['id_customer']){
                                                                        $active_comment = 'comment-active';
                                                                    }
                                                                }
                                                        ?>

                                                            <div class="single-rating <?php echo $active_comment ?>">
                                                                <div class="rating-author">
                                                                    <img src=<?php
                                                                        if(substr($value['image'], 0, 4) == 'http'){
                                                                            echo $value['image'];
                                                                        }
                                                                        else{
                                                                            echo _WEB_ROOT . IMG_PATH . 'customer/' . $value['image'];
                                                                        }
                                                                    ?> alt="#">
                                                                </div>
                                                                <div class="rating-des">
                                                                    <h6><?php echo $value['name'] ?></h6>

                                                                    <div class="ratings">
                                                                        <ul class="rating">

                                                                            <?php for ($i = 0; $i < 5; $i++) { ?>

                                                                                <?php if ($i < $value['rate']) { ?>

                                                                                    <li><i class="fa fa-star"></i></li>

                                                                                <?php } else { ?>

                                                                                    <li><i class="fa fa-star-o"></i></li>

                                                                            <?php }
                                                                            } ?>

                                                                        </ul>
                                                                        <div class="rate-count">(<span><?php echo $value['rate'] ?></span>)</div>
                                                                    </div>
                                                                    <p><?php echo $value['content'] ?></p>
                                                                    <p style="font-size:0.75rem; color:#b9b5b5"><?php echo $value['create_date'] ?></p>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>

                                                </div>

                                                <div class="comment-review">
                                                    <div class="add-review">
                                                        <h5>Add A Review</h5>
                                                        <p>Your email address will not be published. Required fields are marked</p>
                                                    </div>
                                                    <h4>Your Rating</h4>
                                                    <div class="review-inner">
                                                        <div class="ratings">
                                                            <ul class="rating rating-input">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="none">
                                                        <input type="checkbox" class="rate-input" name="rate[]" value="">
                                                        <input type="checkbox" class="rate-input" name="rate[]" value="">
                                                        <input type="checkbox" class="rate-input" name="rate[]" value="">
                                                        <input type="checkbox" class="rate-input" name="rate[]" value="">
                                                        <input type="checkbox" class="rate-input" name="rate[]" value="">
                                                    </div>
                                                    <!-- <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label>Your Name<span>*</span></label>
                                                                <input type="text" name="name" required="required" placeholder>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label>Your Email<span>*</span></label>
                                                                <input type="email" name="email" required="required" placeholder>
                                                            </div>
                                                        </div> -->
                                                    <div class="col-lg-12 col-12">
                                                        <div class="form-group">
                                                            <label>Write a review<span>*</span></label>
                                                            <textarea class="comment-message" rows="6" placeholder></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-12">
                                                        <div class="form-group button5">
                                                            <?php
                                                            if (isset($_SESSION['id_customer'])) {
                                                                if ($data['can_comment'] != 0) {
                                                            ?>

                                                                    <button disabled class="btn comment-submit">Submit</button>

                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <button disabled class="btn">Submit</button>

                                                                <?php
                                                                }
                                                            } else {
                                                                ?>

                                                                <a style="color:white !important" href=<?php echo _WEB_ROOT . '/item-' . $data['product']['id'] . '/login' ?> class="btn comment-submit">Submit</a>

                                                            <?php
                                                            }
                                                            ?>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var rateInput = document.querySelectorAll('.rate-input');
    var rateValue = document.querySelectorAll('.rating-input i');
    var commentSubmitBtn = document.querySelector('.comment-submit');
    var msg = document.querySelector('.comment-message');
    var rating = 0;

    msg.oninput = () => {
        if (rating) {
            commentSubmitBtn.disabled = false;
        }
    }

    commentSubmitBtn.onclick = () => {
        clean_comment = '';

        $.ajax({
            url: "<?php echo _WEB_ROOT . '/product/check_comment_valid' ?>",
            method: 'post',
            dataType: 'json',
            data: {
                msg: msg.value,
            },
            success: (result) => {
                clean_comment = result;

                $.ajax({
                    url: "<?php echo _WEB_ROOT . '/product/handle_comment/' . $data['product']['id'] ?>",
                    method: 'post',
                    dataType: 'json',
                    data: {
                        msg: clean_comment,
                        rating: rating
                    },
                    success: (result) => {
                        let rate = `<li class="total-rating">${Math.round((result.rate*10))/10}</li>`;

                        let comment = '';

                        for (let j = 0; j < 5; j++) {
                            if (j < result.rate && j + 1 > result.rate) {
                                rate += `<li><i class = "fa fa-star-half-o"></i></li>`;
                            } else if (result.rate > j) {
                                rate += `<li><i class = "fa fa-star"></i></li>`;
                            } else {
                                rate += `<li><i class = "fa fa-star-o"></i></li>`;
                            }
                        }

                        $('.product-rate').html(rate);
                        $('.avg-ratting h4').html(result.rate + '<span>(Overall)</span>');


                        result.comment.forEach((item, key) => {
                            let commentRate = '';

                            for (i = 0; i < 5; i++) {
                                if (i < item['rate']) {
                                    commentRate += `<li><i class="fa fa-star"></i></li>`;
                                } else {
                                    commentRate += `<li><i class="fa fa-star-o"> </i></li>`;
                                }
                            }

                            let img = '';

                            if(item.image.slice(0, 4) == 'http'){
                                img = item.image;
                            }
                            else{
                                img = './assest/images/customer/' + item.image;
                            }
                            
                            let activeComment = '';

                            if(item.id_customer == <?php echo $_SESSION['id_customer']['id'] ?>){
                                activeComment = 'comment-active';
                            }

                            comment += `
                            <div class="single-rating ${activeComment}">
                                <div class="rating-author">
                                    <img src=${img} alt="#">
                                </div>
                                <div class="rating-des">
                                    <h6> ${item['name']} </h6>

                                    <div class="ratings">
                                        <ul class="rating">
                                            ${commentRate}
                                        </ul>
                                        <div class="rate-count"> 
                                            ( <span> ${item.rate} </span>)
                                        </div>
                                    </div>
                                    <p> ${item.content} </p>
                                    <p style="font-size:0.75rem; color:#b9b5b5"> ${item.create_date} </p>
                                </div>
                            </div>`
                        });

                        $('.comment-list').html(comment);

                        $('.total-review').html('(' + "<?php echo $data['product']['review'] + 1 ?>" + ') Review');
                    }
                });
            }
        });


        msg.value = "";

        for (let i = 4; i > -1; i--) {
            rateValue[i].classList.remove('fa-star');
            rateValue[i].classList.add('fa-star-o');
            rateInput[i].checked = false;
        }

        commentSubmitBtn.disabled = true;
    }


    rateValue.forEach((item, key) => {
        item.onclick = () => {
            for (let i = 4; i > -1; i--) {
                rateValue[i].classList.remove('fa-star-o');
                rateInput[i].checked = false;
            }

            for (let i = 4; i > -1; i--) {
                if (i <= key) {
                    rateValue[i].classList.add('fa-star');
                    rateInput[i].checked = true;
                } else {
                    rateValue[i].classList.add('fa-star-o');
                    rateInput[i].checked = false;
                }
            }

            if (msg.value != '') {
                commentSubmitBtn.disabled = false;
            }

            rating = key + 1;
        }
    });
</script>