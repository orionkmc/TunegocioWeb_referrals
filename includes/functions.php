<?php
add_action('pre_footer','output_text', 5);

function output_text() {
    echo '<p>Your text.</p>';
}