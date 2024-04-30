<section style="background-color: #F6F7FB;">
    <div class="container py-3 customer">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h4 class="my-3">
                            Account Found
                        </h4>
                    </div>
                    <div class="repass-form">
                        <div class="">
                           <img src=<?php 
                            if (substr($_SESSION['id_customer']['image'], 0, 4) != 'http') {
                                echo _WEB_ROOT . IMG_PATH . 'customer/' . $data['avatar'] ;
                            } else {
                                echo $data['avatar'];
                            }
                           ?> alt="" style="width:70px; height:70px; margin-bottom:8px; border-radius:50%; border: 2px solid #333">
                        </div>
                        <div class="" style="margin-bottom:8px">
                            <p>
                                Your account: <?php echo $data['account'] ?>
                            </p>
                        </div>
                        <form action=<?php echo _WEB_ROOT . '/profile/change_password/' . $data['id'].'/change' ?> method="post" class="mb-3">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>