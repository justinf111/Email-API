<?php


namespace App\Actions;


class SwapEmailService
{
    public function execute($provider = '') {
        $prefix = 'mail.'.$provider ? $provider.'_' : '';
        $transport = new \Swift_SmtpTransport(
            config('mail.'.$prefix.'host'),
            config('mail.'.$prefix.'port'),
            config('mail.'.$prefix.'encryption')
        );
        $transport->setUsername(config('mail.'.$prefix.'username'));
        $transport->setPassword(config('mail.'.$prefix.'username'));

        $emailProvider = new \Swift_Mailer($transport);

        // set mailtrap mailer
        \Mail::setSwiftMailer($emailProvider);
    }
}