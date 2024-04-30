<section style="background-color: #F6F7FB;">
    <div class="container py-3 customer">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h4 class="my-3">
                            Fill Code
                        </h4>
                    </div>

                    <div class="repass-form">
                        <div class="">
                            <p>
                                Your Email: <?php echo $data['email'] ?>
                            </p>
                        </div>
                        <form action=<?php echo _WEB_ROOT . '/profile/check_verify_code/' . $data['email'].'/'.$data['path'] ?> method="post" class="mb-3">

                            <div class="mb-3">
                                <label class="form-label" for="verify-code">Code <span>*</span></label>
                                <div class="send-mail">
                                    <input type="text" name="verify-code" id="verify-code">

                                    <a class="resend-mail disable" href=<?php echo _WEB_ROOT . '/profile/send_email/' . $data['email'].'/'.$data['path'] ?>>
                                        Resend (10)
                                    </a>

                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn">Check</button>
                            </div>
                            <div class="col-12" id="login-error-list" style="color:red; padding-top:16px">

                                <?php 
                                    if(isset($_SESSION['verify_errors'])){
                                        echo $_SESSION['verify_errors'];
                                    }
                                ?>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var resendButton = document.querySelector('.resend-mail');
    var countDown = 11;

    function clear(id){
        clearTimeout(id);
        resendButton.classList.remove('disable');
    }

    function setTime(button, time){
        var id = setTimeout(() => {
            setTime(button, time);
        }, 1000);
        time--;
        if(!time){
            clear(id);
        }
        resendButton.innerHTML = 'Resend ('+ time +')';
    }

    setTime(resendButton, countDown);
    resendButton.onclick = () => {
        if(!resendButton.classList.contains('disable')){
            resendButton.classList.add('disable')
        }
    }

</script>