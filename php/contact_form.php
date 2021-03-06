<?php

	$to = 'info@colectivodecinedemadrid.com'; // please change this email id
	
	
	$errors = array();
	// print_r($_POST);

	// Check if name has been entered
	if (!isset($_POST['name'])) {
		$errors['name'] = 'Introduzca su nombre';
	}
	if (!isset($_POST['phone'])) {
		$errors['phone'] = 'Introduzca su teléfono';
	}
	
	// Check if email has been entered and is valid
	if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = 'Introduzca un email válido';
	}
	
	//Check if message has been entered
	if (!isset($_POST['message'])) {
		$errors['message'] = 'Introduzca su mensaje';
	}

	$errorOutput = '';

	if(!empty($errors)){

		$errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
 		$errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

		$errorOutput  .= '<ul>';

		foreach ($errors as $key => $value) {
			$errorOutput .= '<li>'.$value.'</li>';
		}

		$errorOutput .= '</ul>';
		$errorOutput .= '</div>';

		echo $errorOutput;
		die();
	}



	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$from = $email;
	$subject = 'Mensaje desde formulario web Colectivo de Cine de Madrid';
	
	$body = "De: $name\n Telefono:$phone\n E-Mail: $email\n Mensaje:\n $message";


	//send the email



    $options = array(
        'http' => array (
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    
    
    if (mail ($to, $subject, $body)) {
        echo 'Formulario enviado con exito. Nos pondremos en contacto con usted es cuanto nos sea posible';
    } else {
        echo 'Se ha producido un error en el envio del formulario.<br> Intentelo por favor de nuevo transcurridos unos minutos.<br> Disculpen las molestias';
    }
?>
	