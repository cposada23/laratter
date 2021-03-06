<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $users = factory(App\User::class, 15)->create();

        // le doy acceso a la variable externa $users
        $users->each(function(App\User $user) use ($users){
            $messages = factory(App\Message::class)
                    ->times(20)
                    ->create([
                        'user_id' => $user->id,
                    ]);

            $messages->each(function (App\Message $message) use ($users) {
                factory(App\Response::class, random_int(1,10))-> create(
                    [
                        'message_id'=>$message->id,
                        'user_id' => $users->random(1)->first()->id
                    ]
                );

            });
            $user->follows()->sync(
                $users->random(10)
            );
        });
    }
}
