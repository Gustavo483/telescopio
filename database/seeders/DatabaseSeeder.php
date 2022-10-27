<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeed::class);
        $this->call(alunosSeed::class);
        $this->call(unidadeSeed::class);
        $this->call(conteudosSeed::class);
        $this->call(cursoSeed::class);
        $this->call(QuestoesFizacaoSeed::class);
        $this->call(QuestoestesteSeed::class);
    }
}
