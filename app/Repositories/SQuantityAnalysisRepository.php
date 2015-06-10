<?php namespace App\Repositories;

use Illuminate\Redis\Database as PRedis;

class SQuantityAnalysisRepository
{
    protected $fillable = [
        'item_name',
        'item_unit'
    ];

    protected $redisHashKey = 'quantity_analysis';

    protected $redis;

    public function __construct(PRedis $redis)
    {
        $this->redis = $redis;
    }

    public function create($workId, $attributes)
    {
        $cachedRand = $workId;

        foreach (array_only($attributes, $this->fillable) as $key => $value) {
            $this->redis->hmset(
                "{$this->redisHashKey}:{$cachedRand}",
                $key,
                $value
            );
        }

        return $cachedRand;
    }

    public function find($workId)
    {
        return $this->redis->hgetall("{$this->redisHashKey}:{$workId}");
    }
}
