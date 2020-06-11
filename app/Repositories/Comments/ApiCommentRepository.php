<?php

declare(strict_types = 1);

namespace App\Repositories\Comments;

use App\Repositories\JsonTrait;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

final class ApiCommentRepository implements CommentRepository
{
    use JsonTrait;

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function byPostId(int $postId): Collection
    {
        $json     = $this->client->get("posts/$postId/comments")->getBody();
        $comments = $this->decode($json);

        return $comments->map(fn(\stdClass $comment): array => self::mapComment($comment));
    }

    private static function mapComment(\stdClass $data): array
    {
        return [
            'id'         => $data->id,
            'post_id'    => $data->postId,
            'name'       => $data->name,
            'email'      => $data->email,
            'body'       => $data->body,
            'created_at' => Carbon::now()
        ];
    }
}