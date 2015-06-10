<?php namespace App\Repositories;

use Illuminate\Redis\Database as PRedis;

class SSelfCheckRepository
{
    protected $fillable = [
        'name',
        'item_name',
        'item_details'
    ];

    protected $redisHashKey = 'self_check';

    protected $redis;

    public function __construct(PRedis $redis)
    {
        $this->redis = $redis;
    }

    public function create($attributes)
    {
        $selfCheckId = rand();

        foreach (array_only($attributes, $this->fillable) as $key => $value) {
            $this->redis->hmset(
                "{$this->redisHashKey}:{$selfCheckId}",
                $key,
                $value
            );
        }

        return $selfCheckId;
    }

    public function all()
    {
        $keys = $this->redis->keys("{$this->redisHashKey}:*");
        $selfChecks = [];

        foreach ($keys as $key) {
            $selfCheckId = explode(':', $key)[1];
            $selfChecks[$selfCheckId] = $this->redis->hgetall($key);
        }

        return $selfChecks;
    }

    public function destroy($selfCheckId)
    {
        return $this->redis->del("{$this->redisHashKey}:{$selfCheckId}");
    }

    public function find($selfCheckId)
    {
        return $this->redis->hgetall("{$this->redisHashKey}:{$selfCheckId}");
    }
}
