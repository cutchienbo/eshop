

<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Login</h2>
                    <p>Please register in order to checkout more quickly</p>
                    
                    <form class="form account-form" method="post" action=<?php echo _WEB_ROOT . '/login' . '/validate_login' . '/' . $data['direction'] ?>>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Account<span>*</span></label>
                                    <input type="text" value="<?php echo $_SESSION['login']['account'] ?>" name="account" placeholder required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Password<span>*</span></label>
                                    <input type="password" value="<?php echo $_SESSION['login']['password'] ?>" name="password" placeholder required="required">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Captcha code<span>*</span></label>
                                    <div style="display:flex; align-items:center">

                                        <input maxlength="6" minlength="0" class="captcha-input" type="text" name="captcha" placeholder required="required">

                                        <div class="captcha-box" style="display:flex; align-items:center">
                                            <div class="captcha-reload"> <i class="ti-reload"></i></div>
                                            <img class="login-captcha" src=<?php echo _WEB_ROOT .'/login/captcha' ?> alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group login-btn">
                                    <button class="btn" type="submit">Login</button>
                                    <a href=<?php echo _WEB_ROOT . '/register' ?> class="btn">Register</a>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">Remember me</label>
                                </div>
                                <a href=<?php echo _WEB_ROOT . '/find_account'; ?> class="lost-pass">Lost your password?</a>
                            </div>
                            <div class="col-12" id="login-error-list" style="color:red; padding-top:16px">

                                <?php echo $data['errors'] ?>

                            </div>
                        </div>
                    </form>
                    <div class="account-google">
                        <a href=<?php echo _WEB_ROOT . '/login/login_by_google/' . $data['direction'] ?>>
                            <i class="ti-google"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var captchaReloadBtn = document.querySelector('.captcha-reload');
    var captchaImg = document.querySelector('.login-captcha');  

    captchaReloadBtn.onclick = () => {
         captchaImg.src = "";
         captchaImg.src = "<?php echo _WEB_ROOT .'/login/captcha' ?>";    
    }
</script>
