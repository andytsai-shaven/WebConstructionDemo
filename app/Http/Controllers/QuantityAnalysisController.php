<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Redis\Database as PRedis;

class QuantityAnalysisController extends Controller
{
    protected $hashKey = 'quantity_analysis';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PRedis $redis)
    {
        $redis = $redis->connection();

        $keys = $redis->keys($this->hashKey . ':*');

        foreach ($keys as $key) {
            $quantityAnalysisList[explode(':', $key)[1]] = $redis->hgetall($key);
        }

        return view('internals/quantityAnalysis/index', compact('quantityAnalysisList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('internals/quantityAnalysis/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, PRedis $redis)
    {
        $inputs = $request->except(['_token']);
        $redis = $redis->connection();

        $hashName = $this->hashKey . ':' . rand();

        $redis->hmset($hashName, 'name', $inputs['quantity_analysis_name']);

        foreach ($inputs['item_name'] as $key => $itemName) {
            $redis->hmset($hashName, $itemName, $inputs['item_unit_name'][$key]);
        }

        return redirect('/internals/quantity-analysis');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($quantityAnalysisId, PRedis $redis)
    {
        $redis = $redis->connection();

        $quantityAnalysis = $redis->hgetall($this->hashKey . ':' . $quantityAnalysisId);

        $quantityAnalysis['id'] = $quantityAnalysisId;

        return view('internals/quantityAnalysis/show', compact('quantityAnalysis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($quantityAnalysisId, PRedis $redis)
    {
        $redis = $redis->connection();

        $quantityAnalysis = $redis->hgetall($this->hashKey . ':' . $quantityAnalysisId);

        $quantityAnalysis['id'] = $quantityAnalysisId;

        return view('internals/quantityAnalysis/edit', compact('quantityAnalysis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($quantityAnalysisId, PRedis $redis, Request $request)
    {
        $inputs = $request->except(['_token', '_method']);
        $redis = $redis->connection();

        $hashName = $this->hashKey . ':' . $quantityAnalysisId;

        $redis->hmset($hashName, 'name', $inputs['quantity_analysis_name']);

        foreach ($inputs['item_name'] as $key => $itemName) {
            $redis->hmset($hashName, $itemName, $inputs['item_unit_name'][$key]);
        }

        return redirect("/internals/quantity-analysis/$quantityAnalysisId");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($quantityAnalysisId, PRedis $redis)
    {
        $redis = $redis->connection();

        $redis->del($this->hashKey . ':' . $quantityAnalysisId);

        return redirect('/internals/quantity-analysis');
    }

    public function search(Request $request)
    {
        $target = $request->input('target');

        return redirect("/internals/quantity-analysis/search/$target");
    }

    public function doSearch(PRedis $redis, $target = null)
    {
        $quantityAnalysisList = null;

        if (!empty($target)) {
            $redis = $redis->connection();
            $keys = $redis->keys($this->hashKey . ':*');

            foreach ($keys as $key) {
                $quantityAnalysisList[explode(':', $key)[1]] = $redis->hgetall($key);
            }

            $quantityAnalysisList = array_slice(
                $quantityAnalysisList,
                rand(0, count($quantityAnalysisList)),
                rand(0, count($quantityAnalysisList)),
                true
            );
        }

        return view('internals/quantityAnalysis/search', compact('target', 'quantityAnalysisList'));
    }
}
