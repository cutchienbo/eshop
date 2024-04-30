<?php
    $routes['default_controller'] = 'home';

    $routes['login/validate_login/item-(.+)'] = 'login/validate_login/item-$1';

    $routes['login/login_by_google'] = 'login/login_by_google';

    $routes['(.+)/login'] = 'login/index/$1';

    $routes['add_item/(.+)'] = 'product/add_item/$1';

    $routes['item-(.+)/login'] = 'login/index/$1';

    $routes['login/log_out/item-(.+)'] = 'login/log_out/item-$1';

    $routes['item-(.+)'] = 'product/detail/$1';

    $routes['forget_password/(.+)'] = 'profile/forget_password/$1';

    $routes['new_email/(.+)'] = 'profile/new_email/$1';

    $routes['find_account'] = 'profile/find_account';
?>