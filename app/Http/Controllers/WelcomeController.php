<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

use Storage;

class WelcomeController extends Controller {
	const SALUT = 'Bonjour';
	const ENVOI = 'Envoi Email';

	public function index( $n = 1 ) {

		// Storage::disk('local')->put('recettes.txt', 'Contenu du fichier');

		/*
				echo '<h3><pre>';
				var_dump(config('database.connections.mysql'));
				echo '</pre></h3>';

		*/
		if ( $n === 1 ) {
			$contact['nom']     = 'Lionel';
			$contact['email']   = 'MonEmail@ddd.ccc';
			$contact['message'] = 'Tatati... V4 simplifié.';

			// Mail::to('grcote7@gmail.com')->send(new Contact($contact));

			/*
							$dmn = 'COTE7.com';
							$from=$contact['email'];

						$headers = "From: " . $dmn . "<" . $from . ">\n";
						$headers .= "Reply-To: " . $from . "\n";
						$headers .= "Content-Type: text/html; charset=\"utf-8\"";

							mail('grcote7@gmail.com', 'Contact', $contact['message'], $headers );
			*/

			//$a = self::ENVOI;


			return view( 'emails.contact', [ 'contact' => $contact ] );
		}

		$a = self::SALUT;

		return view( 'front.welcome', [ 'n' => $n, 'a' => $a ] );
	}
}
