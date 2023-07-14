<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasksData = [
            ['id'=>1, 'name'=>'task one', 'descripton'=>'this is very simple task'],
            ['id'=>2, 'name'=>'task two', 'descripton'=>'this is very simple task'],
            ['id'=>3, 'name'=>'task three', 'descripton'=>'this is very simple task'],
            ['id'=>4, 'name'=>'task fours', 'descripton'=>'this is very simple task']
        ];
        Task::insert($tasksData);
    }
}
