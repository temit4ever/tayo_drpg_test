<?php

namespace App\Console\Commands;

use App\Models\User;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use App\Services\MakeRequests;

class UserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetch the user data from API data and refresh database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle(MakeRequests $makeRequests)
    {
        $api_response = $makeRequests->getResponse();
        if (User::first() == null) {
            $this->insert($api_response);
        }
        $this->refresh($api_response);
    }

    /**
     * Fetch response from the api and create record in the user table
     *
     * @param $data
     * @return void
     */
    public function insert($data): void
    {
            foreach ($data['data'] as $datum) {
                User::create([
                    'id' => $datum['id'],
                    'first_name' => $datum['first_name'],
                    'last_name' => $datum['last_name'],
                    'email' => $datum['email'],
                    'avatar' => $datum['avatar'],
                    'password' => bcrypt($datum['first_name'] . $datum['last_name'])
                ]);
            }
    }

    /**
     * Refresh data in the user table
     *
     * @param $api_data
     * @return void
     */
    public function refresh($api_data): void
    {
        foreach ($api_data['data'] as $data) {
            $user_update = User::find($data['id']);
            if(!empty($user_update)) {
                $user_update->update([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'avatar' => $data['avatar'],
                    'password' => bcrypt($data['first_name'] . $data['last_name'])
                ]);
            }

        }
    }
}
