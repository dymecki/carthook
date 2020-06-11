<?php

declare(strict_types = 1);

namespace App\Repositories\Users;

use App\Repositories\JsonTrait;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

final class ApiUserRepository implements UserRepository
{
    use JsonTrait;

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all(): Collection
    {
        $json  = $this->client->get('users')->getBody();
        $users = $this->decode($json);

        return $users->map(fn(\stdClass $user): array => self::mapUser($user));
    }

    public function get(int $id): array
    {
        $body = $this->client->get("users/$id")->getBody();
        $user = $this->decode($body);

        return self::mapUser($user->first());
    }

    private static function mapUser(\stdClass $data): array
    {
        return [
            'id'         => $data->id,
            'name'       => $data->name,
            'username'   => $data->username,
            'email'      => $data->email,
            'created_at' => Carbon::now()
        ];
    }
}