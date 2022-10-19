<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Users = [
            ['id' => 1, 'name'=>'Aluno um', 'permision'=>1, 'email'=>'aluno1@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 2, 'name'=>'Aluno dois', 'permision'=>1, 'email'=>'aluno2@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 3, 'name'=>'Aluno tres', 'permision'=>1, 'email'=>'aluno3@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 4, 'name'=>'Aluno quatro', 'permision'=>1, 'email'=>'aluno4@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 5, 'name'=>'Aluno cinco', 'permision'=>1, 'email'=>'aluno5@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 6, 'name'=>'Aluno seis', 'permision'=>1, 'email'=>'aluno6@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 7, 'name'=>'Aluno sete', 'permision'=>1, 'email'=>'aluno7@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 8, 'name'=>'Aluno oito', 'permision'=>1, 'email'=>'aluno8@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 9, 'name'=>'Aluno nove', 'permision'=>1, 'email'=>'aluno9@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 10, 'name'=>'Aluno dez', 'permision'=>1, 'email'=>'aluno10@gmail.com', 'password'=>Hash::make('75288Asd')],
            ['id' => 11, 'name'=>'admin', 'permision'=>3, 'email'=>'gu.moura01@gmail.com', 'password'=>Hash::make('75288Asd')],
        ];
        foreach ($Users as $key => $user) {
            User::create($user);
        }
    }
}
