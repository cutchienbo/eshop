<section style="background-color: #F6F7FB;">
    <div class="container py-3 customer">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h4 class="my-3">
                            Verify Email
                        </h4>
                    </div>
                    <div class="repass-form">
                       
                        <form action=<?php echo _WEB_ROOT.'/profile/check_verify_email/'.$data['path'] ?> method="post" class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="verify-email">Your Email <span>*</span></label>
                                <input type="email" name="verify-email" id="verify-email">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn">Verify</button>
                            </div>
                            <div class="col-12" id="login-error-list" style="color:red; padding-top:16px">

                                <?php echo $data['error'] ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>