<?php

namespace App;

use App\Models\Broker;
use App\Models\User;
use Jasny\ValidationResult;
use Jasny\SSO;

/**
 * Example SSO server.
 */
class MySSOServer extends SSO\Server
{

    /**
     * Get the API secret of a broker and other info
     *
     * @param string $brokerId
     * @return array
     */
    protected function getBrokerInfo($brokerId)
    {
        $broker = Broker::where(['id' => $brokerId])->first();

        if($broker)
            return $broker->toArray();

        return null;
    }

    /**
     * Authenticate using user credentials
     *
     * @param string $email
     * @param string $password
     * @return ValidationResult
     */
    protected function authenticate($email, $password)
    {
        if (!isset($email)) {
            return ValidationResult::error("email isn't set");
        }
        
        if (!isset($password)) {
            return ValidationResult::error("password isn't set");
        }


        //Checking user credentials
        $user = User::where(['email' => $email])->first();
        if (!$user || !password_verify($password, $user->password)) {
            return ValidationResult::error("Invalid credentials");
        }


        //Checking user access to the website
        $broker_IP = $_SERVER['REMOTE_ADDR'];
        $broker = Broker::where(['IP' => $broker_IP])->first();

        if($user->brokers()->contains($broker))
            return ValidationResult::success();
        else
            return ValidationResult::error("No access to this website");

    }


    /**
     * Get the user information
     *
     * @return array
     */
    protected function getUserInfo($email)
    {
        $user = User::where(['email' => $email])->first();

        if (!$user)
            return null;
        
        return $user->toArray();
    }
}
