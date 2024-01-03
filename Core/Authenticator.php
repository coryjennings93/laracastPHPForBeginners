<?php

namespace Core;

class Authenticator
{
    protected $user;

    public function attempt($email, $password)
    {
        // match credentials
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->find();

        // runs if a user is found in the database
        if ($user) {
            // have a user, but we need to see if the provided password matches one in database
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email
                ]);

                return true;
            }
        }

        return false;
    }

    public function login($user)
    {
        // $_SESSION['logged in'] = true;
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        // regenerates the session id
        session_regenerate_id(true);
    }

    public function logout()
    {
        // log the user out by flushing session data and expiring the cookie
        Session::destroy();
    }
}
