<?php

function kdb_add_member(): void {
	
	if( isset($_POST['add_member']) ){
		$form = [];
		wp_parse_str($_POST['add_member'], $form);
		$errors = kdb_form_error($form);
		if ( $errors ) {
			$error = [];
			foreach ( $errors as $key => $val ){
				$error[] = $val;
			}
			wp_send_json_error($error);
		}else {
			$duplicate = member_exists( $form );
			if( $duplicate ) {
				wp_send_json_error($duplicate);
			}else{
				kdb_insert_data($form);
				send_success_mail($form['email']);
				wp_send_json_success( 'Vos données ont été comptabilisées avec succès! <br> Veuillez rafraichir la page pour voir le nouveau total d\'actions cumulées', '200' );

			}
		}
	}else{
		wp_send_json_error("Sorry, something went wrong, please reload the page and try again.");
	}
}
add_action('wp_ajax_nopriv_kdb_add_member', 'kdb_add_member');
add_action('wp_ajax_kdb_add_member', 'kdb_add_member');

function kdb_insert_data( array $form ): void {
	$ip = $form['ip'] ?? 'Not found';
	$country = $form['country'] ?? 'Not found';
	global $wpdb;
	$table_name = $wpdb->prefix . "atos_stock_data";
    $wpdb->insert(
        $table_name, array(
            'stockholder_name' => $form['name'],
            'email' => $form['email'],
            'phone' => $form['phone'],
            'stock' => $form['stock'],
            'purchase_price' => $form['purchase'],
            'sell_price' => $form['sell'],
            'loss' => $form['loss'],
			'ip' => $ip,
			'country' => $country,	
            'remarks' => $form['remarks']
        )
    );
}

function kdb_form_error(array $form): array {
	$errors = [];
	if ( empty( $form['name'] ) ) {
		$errors['name'] = 'Please enter your name';
	}
	if ( empty( $form['email'] ) ) {
		$errors['email'] = 'Please enter email address';
	}
	if ( empty( $form['phone'] ) ) {
		$errors['phone'] = 'Please enter valid phone number';
	}
// 	if ( empty( $form['stock'] ) ) {
// 		$errors['stock'] = 'Please enter your stock amount';
// 	}
// 	if ( empty( $form['purchase'] ) ) {
// 		$errors['purchase'] = 'Please enter your purchase amount';
// 	}
// 	if ( empty( $form['sell'] ) ) {
// 		$errors['sell'] = 'Please enter your sell amount';
// 	}
// 	if ( empty( $form['loss'] ) ) {
// 		$errors['loss'] = 'Please enter your loss amount';
// 	}

	if ( empty( $form['stock'] ) ) {
		$form['stock'] = '0';
	}	
	if ( empty( $form['purchase'] ) ) {
		$form['purchase'] = '0';
	}
	if ( empty( $form['sell'] ) ) {
		$form['sell'] = '0';
	}
	if ( empty( $form['loss'] ) ) {
		$form['loss'] = '0';
	}	
	if ( empty( $form['remarks'] ) ) {
		$form['remarks'] = '-';
	}
	return $errors;
}

function member_exists(array $form): array {
	$error = [];
	global $wpdb;
	$table_name = $wpdb->prefix . "atos_stock_data";
	$ip = $form['ip'];
	$email = $form['email'];
	$phone = $form['phone'];
	$checkEmail = $wpdb->get_var("SELECT ID FROM $table_name WHERE email = '$email'");
	$checkPhone = $wpdb->get_var("SELECT ID FROM $table_name WHERE phone = '$phone'");

	if( $checkEmail !== NULL || $checkPhone !== NULL ){
		$error['message'] = 'Another entry matched with the phone number or email address you entered. Please contact admin@upra.fr, if you mistakenly submitted wrong information.';
	}

	// $checkIp = $wpdb->get_var("SELECT ID FROM $table_name WHERE ip = '$ip'");

	// if($checkIp !== NULL){
	// 	$error['message'] = 'Attempt to submit multiple entry. Please do not submit multiple entry.';
	// }

	return $error;
}


// function send_success_mail($address){
// 	$to = $address;
// 	$subject = 'UPRA Registration';
// 	$message = 'L’UPRA vous remercie de votre pré-inscription. Celle-ci a bien été prise en compte.<br>Nous reviendrons vers vous d’ici mi-avril lorsque la plateforme applicative de gestion de procès de groupe aura été mise en place. Cette plateforme sécurisée répondant aux normes les plus strictes de respect de la vie privée.<br>Vous recevrez également mi-avril un email vous indiquant la liste des pièces à préparer.<br>Si vous avez une question d’ici là, une seule adresse : <b>info@upra.fr</b>';
	
// 	$headers = ['Content-Type: text/html; charset=UTF-8'];

// 	wp_mail( $to, $subject, $message, $headers );
// }


function send_success_mail($address) {
    $to = $address;
    $subject = 'UPRA Registration';
    $message = '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            .container {
                background-color: #ffffff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            h1 {
                color: #2a8bba;
                font-size: 24px;
            }
            p {
                font-size: 16px;
                line-height: 1.6;
            }
            .highlight {
                color: #2a8bba;
                font-weight: bold;
            }
            .footer {
                font-size: 14px;
                margin-top: 20px;
                color: #888;
            }
            .footer a {
                color: #2a8bba;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Merci pour votre pré-inscription à l’UPRA</h1>
            <p>L’UPRA vous remercie de votre pré-inscription. Celle-ci a bien été prise en compte.</p>
            <p>Nous reviendrons vers vous d’ici mi-avril lorsque la plateforme applicative de gestion de procès de groupe aura été mise en place. Cette plateforme sécurisée répondra aux normes les plus strictes de respect de la vie privée.</p>
            <p>Vous recevrez également mi-avril un email vous indiquant la liste des pièces à préparer.</p>
            <p>Si vous avez une question d’ici là, une seule adresse : <span class="highlight">info@upra.fr</span></p>
            <p class="footer">Cordialement,<br> L’équipe de l’UPRA</p>
        </div>
    </body>
    </html>';

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: UPRA <no-reply@upra.fr>',
        'Reply-To: info@upra.fr'
    ];

    wp_mail($to, $subject, $message, $headers);
}
