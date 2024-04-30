<section style="background-color: #F6F7FB;">
    <div class="container py-3 customer">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h4 class="my-3">
                            Find Account
                        </h4>
                    </div>
                    <div class="repass-form">
                        <form action=<?php echo _WEB_ROOT . '/profile/send_email/handle_find' ?> method="post" class="mb-3" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="find">Email / Phone Number <span>*</span></label>
                                <input type="text" name="find_account_email" id="find">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn">Find</button>
                            </div>
                        </form>
                        <div class="col-12" id="login-error-list" style="color:red; padding-top:16px">

                            <?php echo $data['error'] ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>