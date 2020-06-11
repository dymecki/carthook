<?php

declare(strict_types = 1);

namespace App\Repositories\Posts;

use App\Repositories\JsonTrait;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

final class ApiPostRepository implements PostRepository
{
    use JsonTrait;

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function byUserId(int $userId): Collection
    {
        $json  = $this->client->get("users/$userId/posts")->getBody();
        $posts = $this->decode($json);

        return $posts->map(fn(\stdClass $post): array => self::mapPost($post));
    }

    public function get(int $id): array
    {
        $json = $this->client->get("posts/$id")->getBody();
        $post = $this->decode($json);

        return self::mapPost($post->first());
    }

    private static function mapPost(\stdClass $data): array
    {
        return [
            'id'         => $data->id,
            'user_id'    => $data->userId,
            'title'      => $data->title,
            'body'       => $data->body,
            'created_at' => Carbon::now()
        ];
    }
}