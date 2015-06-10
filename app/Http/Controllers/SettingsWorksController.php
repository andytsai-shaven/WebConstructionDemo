<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\SWorksRepository;
use App\Repositories\SQuantityAnalysisRepository;
use App\Repositories\SSelfCheckRepository;
use Illuminate\Http\Request;
use Illuminate\Redis\Database as PRedis;

class SettingsWorksController extends Controller
{
    protected $redisHashKey = 'work';

    private $types = [
        '基礎工程',
        '結構工程',
        '內外裝飾工程',
        '地坪及屋頂防水工程',
        '其他及門窗工程'
    ];

    private $orders = [
        ['1. 基礎工程', '2. 基礎工程', '3. 基礎工程', '4. 基礎工程', '5. 基礎工程'],
        ['1. 結構工程', '2. 結構工程', '3. 結構工程', '4. 結構工程', '5. 結構工程'],
        ['1. 內外裝飾工程', '2. 內外裝飾工程', '3. 內外裝飾工程', '4. 內外裝飾工程', '5. 內外裝飾工程'],
        ['1. 地坪及屋頂防水工程', '2. 地坪及屋頂防水工程', '3. 地坪及屋頂防水工程', '4. 地坪及屋頂防水工程', '5. 地坪及屋頂防水工程'],
        ['1. 其他及門窗工程', '2. 其他及門窗工程', '3. 其他及門窗工程', '4. 其他及門窗工程', '5. 其他及門窗工程']
    ];

    private $units = [
        '支',
        '式',
        '公尺',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PRedis $redis, SWorksRepository $sWorksRepository)
    {
        $works = $sWorksRepository->all();

        $types = $this->types;
        $orders = $this->orders;
        $units = $this->units;

        return view('settings/works/index', compact('works', 'types', 'orders', 'units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $types = $this->types;
        $orders = $this->orders;
        $units = $this->units;

        return view('settings/works/create', compact('types', 'orders', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(
        Request $request,
        PRedis $redis,
        SWorksRepository $sWorksRepository,
        SQuantityAnalysisRepository $sQuantityAnalysisRepository
    ) {
        $inputs = $request->except('_token');

        $cachedRand = rand();

        $workId = $sWorksRepository->create($inputs);

        // Create Quantity Analysis Table if exists
        if (isset($inputs['item_name']) && isset($inputs['item_unit'])) {
            $sQuantityAnalysisRepository->create($workId, [
                'work_id' => $workId,
                'item_name' => json_encode($inputs['item_name']),
                'item_unit' => json_encode($inputs['item_unit'])
            ]);
        }

        return redirect('/settings/works');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(
        $workId,
        SWorksRepository $sWorksRepository,
        SQuantityAnalysisRepository $sQuantityAnalysisRepository,
        SSelfCheckRepository $sSelfCheckRepository
    ) {
        $types = $this->types;
        $orders = $this->orders;
        $units = $this->units;

        $work = $sWorksRepository->find($workId);
        $quantityAnalysis = $sQuantityAnalysisRepository->find($workId);
        $selfCheck = $sSelfCheckRepository->find($work['self_check']);

        $quantityAnalysis['item_name'] = json_decode($quantityAnalysis['item_name']);
        $quantityAnalysis['item_unit'] = json_decode($quantityAnalysis['item_unit']);

        $selfCheck['item_name'] = json_decode($selfCheck['item_name']);
        $selfCheck['item_details'] = json_decode($selfCheck['item_details']);

        return view('settings/works/show', compact('work', 'quantityAnalysis', 'selfCheck', 'types', 'orders', 'units'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($workId, SWorksRepository $sWorksRepository)
    {
        $sWorksRepository->destory($workId);

        return redirect('/settings/works');
    }

    public function types()
    {
        $types = $this->types;

        return response()->json(compact('types'));
    }

    public function orders()
    {
        $orders = $this->orders;

        return response()->json(compact('orders'));
    }

    public function units()
    {
        $units = $this->units;

        return response()->json(compact('units'));
    }
}
