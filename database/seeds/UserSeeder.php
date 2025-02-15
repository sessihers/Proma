<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Client;
use App\ClientContact;
use App\Project;
use App\ProjectTask;
use App\Issue;
use App\IssueNote;

class UserSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ])->each(function ($user) {
            $user->clients()->saveMany(factory(Client::class, 15)->create()
                ->each(function ($client) {
                    $client->contacts()->saveMany(factory(ClientContact::class, 10)->create([
                        'client_id' => $client->first()->id,
                    ]));
                }));

            $user->projects()->saveMany(factory(Project::class, 25)->create()
                ->each(function ($project) {
                    $project->tasks()->saveMany(factory(ProjectTask::class, 10)->create([
                        'project_id' => $project->first()->id,
                    ]));
                }));

            $user->issues()->saveMany(factory(Issue::class, 25)->create()
                ->each(function ($issue) {
                    $issue->notes()->saveMany(factory(IssueNote::class, 10)->create([
                        'issue_id' => $issue->first()->id,
                    ]));
                }));
        });
    }
}
