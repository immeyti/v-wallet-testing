<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    public function firstMethod()
    {
        /** @var User $user */
        $user = User::firstOrCreate(
            ['name' => 'John Doe'], [
                'name' => 'John Doe',
                'email' => 'john@foo.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);


        if (! $user->getWallets()->where('coin', 'USD')->first()) {
            // create a wallet and do some transactions
            $user->creatWallet('USD');
            $user->deposit('USD', 10, ['foo' => 'bar']);
            $user->withdraw('USD', 5, []);
        }

        // create another wallet
        if (! $user->getWallets()->where('coin', 'ETH')->first()) {
            $user->creatWallet('ETH');
            $user->deposit('ETH', 10);
            $user->withdraw('ETH', 5);
        }

        return $user->balance('USD');
    }

    public function anotherMethod()
    {
        /** @var User $user */
        $user = User::firstOrCreate(
            ['name' => 'John Doe'], [
            'name' => 'John Doe',
            'email' => 'john@foo.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        // create a wallet and do some not valid transactions
        if (! $user->getWallets()->where('coin', 'IRR')->first()) {
            $user->creatWallet('IRR');
            $user->deposit('IRR', 10, ['foo' => 'bar']);
            $user->withdraw('IRR', 15, []);
        }

    }
}
