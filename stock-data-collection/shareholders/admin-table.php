<?php

require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';

class AtosShareholders extends WP_List_Table {

	public function prepare_items() {

		$orderby = isset($_GET['orderby']) ? trim($_GET['orderby']) : "";
		$order = isset($_GET['order']) ? trim($_GET['order']) : "";
		$search_term = isset($_POST['s']) ? trim($_POST['s']) : "";

		$data = $this->wp_list_table_data($orderby, $order, $search_term);

		$columns = $this->get_columns();
		$hidden = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();

		$this->_column_headers = array($columns, $hidden, $sortable);

        //pagination
        $current_page = $this->get_pagenum();        

        $total_items = count($data);

        $per_page = 25;

        $data = array_slice($data,(($current_page-1)*$per_page),$per_page); 

        $this->items = $data;

        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil($total_items/$per_page)
        ) );
	}

	public function wp_list_table_data($orderby = '', $order = '', $search_term = ''): array {
		global $wpdb;
		$table = $wpdb->prefix . "atos_stock_data";

		if (!empty($search_term)) {
			$all_posts = $wpdb->get_results(
				"SELECT id, stockholder_name, email, phone, stock, purchase_price, sell_price, loss, remarks from " . $table . " WHERE (stockholder_name LIKE '%$search_term%' OR email LIKE '%$search_term%')"
			);
		} else {
			if ($orderby == "stock" && $order == "desc") {
				$all_posts = $wpdb->get_results(
					"SELECT id, stockholder_name, email, phone, stock, purchase_price, sell_price, loss, remarks from " . $table . " ORDER BY stock DESC"
				);
			} elseif ($orderby == "stock" && $order == "asc") {
				$all_posts = $wpdb->get_results(
					"SELECT id, stockholder_name, email, phone, stock, purchase_price, sell_price, loss, remarks from " . $table . " ORDER BY stock ASC"
				);
			} elseif ($orderby == "id" && $order == "desc") {
				$all_posts = $wpdb->get_results(
					"SELECT id, stockholder_name, email, phone, stock, purchase_price, sell_price, loss, remarks from " . $table . " ORDER BY id DESC"
				);
			} else {
				$all_posts = $wpdb->get_results(
					"SELECT id, stockholder_name, email, phone, stock, purchase_price, sell_price, loss, remarks from " . $table . " ORDER BY id ASC"
				);
			}
		}

		$posts_array = array();

		if (count($all_posts) > 0) {
			foreach ($all_posts as $index => $post) {
				$posts_array[] = array(
					"id" => $post->id,
					"stockholder_name" => $post->stockholder_name,
					"email" => $post->email,
					"phone" => $post->phone,
					"stock" => $post->stock,
					"purchase_price" => $post->purchase_price,
					"sell_price" => $post->sell_price,
					"loss" => $post->loss,
					"remarks" => $post->remarks
				);
			}
		}else{
			$posts_array[] = array(
				"id" => 'Not Found',
				"stockholder_name" => '',
				"email" => '',
				"phone" => '',
				"stock" => '',
				"purchase_price" => '',
				"sell_price" => '',
				"loss" => '',
				"remarks" => ''
			);
		}

		return $posts_array;
	}
	public function get_hidden_columns(): array {
		return array( );
	}

	public function get_sortable_columns(): array {
		return array(
			"id" => array(
				"id", true
			),
            "stock" => array(
                "stock", false
            )
		);
	}

	public function get_columns(): array {
		return array(
			"id" => "ID",
			"stockholder_name" => "Name",
			"email" => "Email",
			"phone" => "Phone",
			"stock" => "Stock",
			"purchase_price" => "Purchase Price",
			"sell_price" => "Sell Price",
			"loss" => "Loss",
			"remarks" => "Remarks"
		);
	}

    public function column_default($item, $column_name){
        switch($column_name){
            case 'id':
            case 'stockholder_name':
            case 'email':
			case 'phone':
			case 'stock':
			case 'purchase_price':
			case 'sell_price':
			case 'loss':
			case 'remarks':
            default:
                return $item[$column_name];
        }
    }

}

function show_member_fn(): void {
	$members = new AtosShareholders();
	$members->prepare_items();
	echo '<div class="wrap"><h1 class="wp-heading-inline">List of ATOS share owners</h1>';
	echo "<form method='post' name='search_shareholder' action='" . $_SERVER['PHP_SELF'] . "?page=atos_shareholders'>";
	$members->search_box("Search Name(s)", "search_shareholder");
	echo "</form>";
	$members->display();

    $totalShare = (int)getAtosData();
    $totalPart = (int)getAtosParticipation();
	$people = getAtosRows();

    echo '<h2 style="text-align: center;background-color: #ccdee8;padding: 10px 0;color: #000000;">Total Stakes: <span style="color:green;">' . number_format($totalShare) . '</span> | Total Participation: <span style="color:green;">' . number_format($totalPart) . '</span> | Number of People: <span style="color:green;">' . $people .'</span></h2></div>';
}

show_member_fn();