<!-- <?php
        print_r($order);
        ?> -->
<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th class="text-center">#</th>
                            <th class="text-center">ORDER VALUES</th>
                            <th class="text-center">EDIT VALUES</th>
                        </tr>
                    </thead>
                    <tbody>

                        <form id="edit_order" action=<?php echo _WEB_ROOT . '/cart/handle_edit_order/' . $order['id_cart'] . '/' . $order['id_customer'] ?> method="post">
                            <tr>
                                <td>
                                    <b>Receiver</b>
                                </td>
                                <td>
                                    <?php echo $order['receiver'] ?>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="receiver" placeholder="Receiver">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Location</b>
                                </td>
                                <td>
                                    <?php echo $order['location'] ?>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="location" placeholder="Location">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Phone</b>
                                </td>
                                <td>
                                    <?php echo $order['phone_number'] ?>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="phone_number" placeholder="Phone">
                                    </div>
                                </td>
                            </tr>
                        </form>

                    </tbody>
                </table>


                <!--/ End Shopping Summery -->
            </div>

        </div>

        <div class="edit-cart-submit">
            <button form="edit_order" class="btn" type="submit">Save</button>
        </div>

    </div>
</div>