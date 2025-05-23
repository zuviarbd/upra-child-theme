<?php
//shareholders
function show_atos_share_menu(): void {
	$icon = 'dashicons-chart-pie';
	$parent_page = add_menu_page('Atos Shares', 'Atos Shares', 'manage_options', 'atos_shareholders', 'atos_shareholders_cb', $icon, 80);
}
add_action('admin_menu', 'show_atos_share_menu');


//shareholders
function atos_shareholders_cb(): void {
	ob_start();
	include_once 'shareholders/admin-table.php';
	$share_table = ob_get_contents();
	ob_end_clean();

	echo $share_table;
}