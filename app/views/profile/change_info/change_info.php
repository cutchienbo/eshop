<section style="background-color: #F6F7FB;">
    <div class="container py-3 customer">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h4 class="my-3">
                            Change Info
                        </h4>
                    </div>
                    <div class="repass-form">
                        <form action=<?php echo _WEB_ROOT.'/profile/handle_change_info/'.$data ?> method="post" class="mb-3" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="new-name">New Name</label>
                                <input type="text" name="new-name" id="new-name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="new-avatar">New Avatar</label>
                                <input type="file" name="new-avatar" id="new-avatar" />
                                <label for="new-avatar">
                                    Choose a file
                                    <i class="ti-export" style="padding-left: 6px"></i>
                                </label>
                            </div>
                            <div class="mb-3 new-avatar-show">
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
<script>
    var uploadImg = document.querySelector(".new-avatar-show");
    var imgFile = document.querySelector("#new-avatar");
    uploadImg.style.opacity = "0";

    imgFile.onchange = function(e) {
        for (var i = 0; e.target.files[i]; i++) {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[i]);
            reader.onload = (e) => {
                const imgTag = document.createElement('img');
                imgTag.src = e.target.result
                uploadImg.appendChild(imgTag);
                uploadImg.style.opacity = "1";
            };
        }
    };
</script>