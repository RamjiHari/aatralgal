<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $user=User::where('email','h@gmail.com')->first();

        if(!$user){
        	User::create([
        		'name' => 'Ramji',
        		'email' => 'h@gmail.com',
        		'password' => Hash::make('password')
        	]);
        }
    }
}
