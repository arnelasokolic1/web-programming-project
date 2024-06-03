<?php

require_once __DIR__ . '/../services/AuthService.class.php';
require_once __DIR__ . '/../config.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set('auth_service', new AuthService());

Flight::group('/auth', function() {
    
    Flight::route('POST /login', function() {
        $payload = Flight::request()->data->getData();
        $patient = Flight::get('auth_service')->get_user_by_email($payload['email']);

        if(!$patient || !password_verify($payload['password'], $patient['password']))
            Flight::halt(500, "Invalid username or password");

        unset($patient['password']); // We should not encode password in token
        $payload = [
            'user' => $patient,
            'iat' => time(), // issued at
            'exp' => time() + 100000 // valid for 1 minute
        ];

        $token = JWT::encode(
            $payload, 
            Config::JWT_SECRET(), 
            'HS256'
        );

        Flight::json([
            'user' => array_merge($patient, ['token' => $token]),
            'token' => $token
        ]);
    });

    Flight::route('POST /logout', function() {
        try {
            $token = Flight::request()->getHeader('Authentication');
            if($token){
                $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
                Flight::json([
                    'jwt_decoded' => $decoded_token,
                    'user' => $decoded_token->user
                ]);
            }
        } catch (\Exception $e){
            Flight::halt(500, $e->getMessage());
        }            
    });
});

?>
