<section style="background-color: #F6F7FB;">
    <div class="container py-3 customer">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h4 class="my-3">
                            Change Email
                        </h4>
                    </div>
                    <div class="repass-form">
                        <form action=<?php echo _WEB_ROOT . '/profile/change_email/' . $data['id_customer'] ?> method="post" class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="new-email">New Email <span>*</span></label>
                                <input type="email" name="new_email" id="new-email" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn">Save</button>
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