<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;

class Captcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $response   = isset($_POST["g-recaptcha-response"]) ? $_POST['g-recaptcha-response'] : null;
        $privatekey = config('app.recaptcha.CAPTCHA_SECRET');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'secret' => $privatekey,
            'response' => $response,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ));

        $resp = json_decode(curl_exec($ch));
        curl_close($ch);
        if ($resp->success) {
            return $resp;
        } else {
            return 'Please complete the recaptcha to submit the form';
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please complete the recaptcha to submit the form';
    }
}
