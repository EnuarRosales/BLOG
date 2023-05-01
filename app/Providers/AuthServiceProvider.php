<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //  ACA ESTAMOS MODIFICANDO EL EMAIL
        VerifyEmail::toMailUsing(function($notifiable, $url){
            return(new MailMessage)
            ->subject('Verificar Cuenta')//ASUNTO LO QUE VE EL USAURIO CUANDO LE LLEGA EL MENSAJE 
            ->line('Tu cuenta ya esta casi lista, solo debes presionar en el enlace')//MENSAJE
            ->action('Confirmar Cuenta',$url)//BOTON
            ->line('Si no creaste esta cuenta puedes ignorar este mensaje');
        });
    }
}
