<section style="background-color: #F6F7FB;">
    <div class="container py-5 customer">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src=<?php

                                    if (substr($_SESSION['id_customer']['image'], 0, 4) != 'http') {
                                        echo _WEB_ROOT . IMG_PATH . 'customer/' . $_SESSION['id_customer']['image'];
                                    } else {
                                        echo $_SESSION['id_customer']['image'];
                                    }
                                    ?> alt="avatar" class="rounded-circle img-fluid profile-avatar" style="width: 150px;">
                        <h5 class="my-3">
                            <?php echo $_SESSION['id_customer']['name'] ?>

                        </h5>
                        <div class="col-sm-12 edit-user">
                            <a href=<?php echo _WEB_ROOT . '/profile/change_info/' . $_SESSION['id_customer']['id'] ?> class="mb-0">
                                <i class="ti-pencil-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <?php if ($_SESSION['account_login'] != 'google') { ?>
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="mb-0">
                                        Account
                                    </p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?php echo $_SESSION['id_customer']['account'] ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="mb-0">Password</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0 password">
                                        <?php for ($i = 0; $i < strlen($_SESSION['id_customer']['password']); $i++) {
                                            echo '*';
                                        } ?>
                                    </p>
                                </div>
                                <div class="col-sm-1 edit-icon">
                                    <i class="ti-eye" check="1"></i>
                                </div>
                                <div class="col-sm-1 edit-icon">
                                    <a href=<?php echo _WEB_ROOT . '/profile/send_email' . '/' . $_SESSION['id_customer']['email'] . '/forget_password' ?> class="mb-0">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-2">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0" style="<?php echo !empty($_SESSION['id_customer']['email']) ? '' : 'color:red !important' ?>">
                                        <?php
                                        if ($_SESSION['id_customer']['email']) {
                                            echo $_SESSION['id_customer']['email'];
                                        } else {
                                            echo 'Verify your email !';
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="col-sm-1 edit-icon">
                                    <a href=<?php
                                            if ($_SESSION['id_customer']['verify']) {
                                                echo _WEB_ROOT . '/profile/send_email/' . $_SESSION['id_customer']['email'] . '/new_email';
                                            } else {
                                                if ($_SESSION['id_customer']['email']) {
                                                    echo _WEB_ROOT . '/profile/send_email/' . $_SESSION['id_customer']['email'] . '/profile';
                                                } else {
                                                    echo _WEB_ROOT . '/profile/verify_email';
                                                }
                                            }
                                            ?> class="mb-0">
                                        <?php if ($_SESSION['id_customer']['verify']) { ?>
                                            <i class="ti-pencil-alt"></i>
                                        <?php } else { ?>
                                            <i class="ti-alert" style="color:red !important"></i>
                                        <?php } ?>

                                    </a>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>


                        <div class="row">
                            <div class="col-sm-2">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0" style="<?php echo !empty($_SESSION['id_customer']['phone_number']) ? '' : 'color:red !important' ?>">
                                    <?php
                                    if ($_SESSION['id_customer']['phone_number']) {
                                        echo $_SESSION['id_customer']['phone_number'];
                                    } else {
                                        echo 'Verify your phone number !';
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="col-sm-1 edit-icon">
                                <a href="#" class="mb-0">
                                    <?php if ($_SESSION['id_customer']['phone_number']) { ?>
                                        <i class="ti-pencil-alt"></i>
                                    <?php } else { ?>
                                        <i class="ti-alert" style="color:red !important"></i>
                                    <?php } ?>
                                </a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-2">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php echo $_SESSION['customer_address'] ?>
                                </p>
                            </div>
                            <div class="col-sm-1 edit-icon">
                                <a href=<?php echo _WEB_ROOT . '/profile/edit_address' ?> class="mb-0">

                                    <i class="ti-pencil-alt"></i>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var eyeIcon = document.querySelector('.ti-eye');
    var passwordField = document.querySelector('.password');

    eyeIcon.onclick = () => {
        if (!eyeIcon.check) {
            passwordField.innerHTML = '<?php echo $_SESSION['id_customer']['password'] ?>';
        } else {
            hidePass = '';
            for (let i = 0; i < <?php echo strlen($_SESSION['id_customer']['password']) ?>; i++) {
                hidePass += '*';
            }
            passwordField.innerHTML = hidePass;
        }
        eyeIcon.check = !eyeIcon.check;
    }
</script>