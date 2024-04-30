<section style="background-color: #F6F7FB;">
    <div class="container py-5 customer">

        <div class="row profile-address">
            <div class="col-lg-12">
                <h5>My Address</h5>
                <div class="add-form none" style="width:50%">
                    <form action=<?php echo _WEB_ROOT.'/profile/handle_add_address/'.$_SESSION['id_customer']['id'] ?> method="post">
                        <input name="address" type="text" style="width:100%">
                        <div>
                            <button type="submit" style="background-color:white; border:none"><i class="ti-check add-form-success"></i></button>
                        </div>
                    </form>
                </div>
                <button class="btn add-address">New address <i class="ti-plus"></i></button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">

                        <?php foreach ($data['address'] as $key => $value) { ?>

                            <div class="row address-card">
                                <div class="col-sm-1">
                                    <p class="mb-0">
                                        <?php echo $key + 1 ?>
                                    </p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">
                                        <span class="address-field"><?php echo $value['location'] ?></span>

                                        <?php if ($value['status'] == 1) { ?>

                                            <span class="address-default">
                                                Default
                                            </span>

                                        <?php } ?>
                                    </p>
                                    <div class="edit-form none">
                                        <input type="text" style="width:75%">
                                        <div>
                                            <i class="ti-check edit-form-success"></i>
                                            <i class="ti-close edit-form-cancel"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn edit-address">
                                        <i class="ti-pencil-alt"></i>
                                    </button>

                                    <a href=<?php echo _WEB_ROOT . '/profile/delete_address/' . $_SESSION['id_customer']['id'] . '/' . $value['id']?>>
                                        <button class="btn delete-address">
                                            <i class="ti-close"></i>
                                        </button>
                                    </a>

                                    <?php if ($value['status'] == 0) { ?>

                                        <a href=<?php echo _WEB_ROOT . '/profile/set_default_address/' . $_SESSION['id_customer']['id'] . '/' . $value['id'] ?>>
                                            <button class="btn">
                                                <i class="ti-check"></i>
                                            </button>
                                        </a>

                                    <?php } ?>
                                </div>
                            </div>

                            <?php if ($key < count($data['address']) - 1) { ?>
                                <hr>
                            <?php } ?>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
</section>
<script>
    var addAddressBtn = document.querySelector('.add-address');
    var addAddressField = document.querySelector('.add-form');

    addAddressBtn.onclick = () => {
        addAddressField.classList.toggle('none');
    }

    var editBtns = document.querySelectorAll('.edit-address');
    var editForms = document.querySelectorAll('.edit-form');
    var cancelEditBtns = document.querySelectorAll('.edit-form-cancel');
    var editInputs = document.querySelectorAll('.edit-form input');
    var successEditBtns = document.querySelectorAll('.edit-form-success');
    var addressFields = document.querySelectorAll('.address-field');

    successEditBtns.forEach((item, key) => {
        item.onclick = () => {
            $.ajax({
                url: "<?php echo _WEB_ROOT . '/profile/handle_edit_address/' . $_SESSION['id_customer']['id'] ?>",
                method: 'post',
                dataType: 'json',
                data: {
                    address: editInputs[key].value,
                    id_address: key + 1
                },
                success: (result) => {
                    addressFields[key].innerHTML = result;
                    editForms[key].classList.toggle('none');
                    editInputs[key].value = '';
                }
            });
        }
    });

    cancelEditBtns.forEach((item, key) => {
        item.onclick = () => {
            editForms[key].classList.toggle('none');
        }
    });

    editBtns.forEach((item, key) => {
        item.onclick = () => {
            editForms[key].classList.toggle('none');
        }
    });
</script>