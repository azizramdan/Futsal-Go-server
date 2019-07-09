<?php
echo password_hash("admin", PASSWORD_BCRYPT);
$hash = '$2y$10$N76KQD64bov2Styq/em./eeg.MS85dZfIaXbTkyETfDH2jIUUYLtS';
if (password_verify('admin', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
