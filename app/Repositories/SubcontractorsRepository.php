<?php

namespace App\Repositories;

use Illuminate\Redis\Database as PRedis;

class SubcontractorsRepository
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'comment',
        'manager_name',
        'manager_phone'
    ];

    protected $redisHashKey = 'subcontractor';

    protected $redis;

    public function __construct(PRedis $redis)
    {
        $this->redis = $redis;
    }

    public function create($attributes)
    {
        $subcontractorId = rand();

        foreach (array_only($attributes, $this->fillable) as $key => $value) {
            $this->redis->hmset(
                "{$this->redisHashKey}:{$subcontractorId}",
                $key,
                $value
            );
        }

        return $subcontractorId;
    }

    public function update($subcontractorId, $attributes)
    {
        try {
            foreach (array_only($attributes, $this->fillable) as $key => $value) {
                $this->redis->hmset(
                    "{$this->redisHashKey}:{$subcontractorId}",
                    $key,
                    $value
                );
            }
        } catch (Exception $e) {
            return false;
        }


        return true;
    }

    public function destroy($subcontractorId)
    {
        return $this->redis->del("{$this->redisHashKey}:{$subcontractorId}");
    }

    public function find($subcontractorId)
    {
        $subcontractor = $this->redis->hgetall("{$this->redisHashKey}:{$subcontractorId}");
        $subcontractor['id'] = $subcontractorId;

        return $subcontractor;
    }

    public function all()
    {
        $keys = $this->redis->keys("{$this->redisHashKey}:*");
        $subcontractors = [];

        foreach ($keys as $key) {
            $subcontractorId = explode(':', $key)[1];
            $subcontractors[$subcontractorId] = $this->redis->hgetall($key);
        }

        return $subcontractors;
    }
}
