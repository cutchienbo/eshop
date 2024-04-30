<section style="background-color: #F6F7FB;">
    <div class="container py-3 customer">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h4 class="my-3">
                            Change Password
                        </h4>
                    </div>
                    <div class="repass-form">
                        <form action=<?php echo _WEB_ROOT.'/profile/change_password/'.$data['customer']['id'] ?> method="post" class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="new-pass">New Password <span>*</span></label>
                                <input type="password" name="new-pass" id="new-pass" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="new-repass">Confirm Password <span>*</span></label>
                                <input type="password" name="confirm-pass" id="new-repass" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn">Save</button>
                            </div>
                            <div class="col-12" id="login-error-list" style="color:red; padding-top:16px">

                                <?php foreach($data['errors'] as $value){ ?>

                                    <?php echo $value ?>

                                <?php } ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>