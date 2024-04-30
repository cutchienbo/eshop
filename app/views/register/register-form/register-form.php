<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Register</h2>
                    <p>Please register in order to checkout more quickly</p>

                    <form class="form account-form" method="post" action=<?php echo _WEB_ROOT . '/register' . '/validate_register' ?>>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Account<span>*</span></label>
                                    <input type="text" name="account" placeholder required="required" value=<?php echo isset($old_data['account']) ? $old_data['account'] : '' ?>>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Name<span>*</span></label>
                                    <input type="text" name="name" placeholder required="required" value=<?php echo isset($old_data['name']) ? $old_data['name'] : '' ?>>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Password<span>*</span></label>
                                    <input type="password" name="register_pass" placeholder required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Confirm Password<span>*</span></label>
                                    <input type="password" name="register_repass" placeholder required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group login-btn">
                                    <button class="btn" type="submit">Register</button>
                                    <a href=<?php echo _WEB_ROOT . '/login' ?> class="btn">Login</a>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">Sign Up for Newsletter</label>
                                </div>
                            </div>
                            <ul class="col-12" id="register-error-list" style="color:red; padding-top:16px">

                                <?php foreach ($errors as $error) { ?>

                                    <li> <?php echo '- ' . $error ?> </li>

                                <?php } ?>

                            </ul>
                        </div>
                    </form>
                    <div class="account-google">
                        <a href=<?php echo _WEB_ROOT . '/register/register_by_google' ?>>
                            <i class="ti-google"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>