<?php namespace App\Repositories;

use Illuminate\Redis\Database as PRedis;

class SWorksRepository
{
    protected $fillable = [
        'type',
        'order',
        'name',
        'unit',
        'belongs',
        'self_check'
    ];

    protected $redisHashKey = 'work';

    protected $redis;

    public function __construct(PRedis $redis)
    {
        $this->redis = $redis;
    }

    public function create($attributes)
    {
        $cachedRand = rand();

        foreach (array_only($attributes, $this->fillable) as $key => $value) {
            $this->redis->hmset(
                "{$this->redisHashKey}:{$cachedRand}",
                $key,
                $value
            );
        }

        return $cachedRand;
    }

    public function destory($workId)
    {
        return $this->redis->del("{$this->redisHashKey}:{$workId}");
    }

    public function find($workId)
    {
        return $this->redis->hgetall("{$this->redisHashKey}:{$workId}");
    }

    public function all()
    {
        $keys = $this->redis->keys("{$this->redisHashKey}:*");
        $works = [];

        foreach ($keys as $key) {
            $workId = explode(':', $key)[1];
            $works[$workId] = $this->redis->hgetall($key);
        }

        return $works;
    }
}
