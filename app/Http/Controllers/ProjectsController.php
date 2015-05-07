<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Redis\Database as PRedis;

class ProjectsController extends Controller
{
    protected $redis;

    private $projectHashKey = 'project';

    public function __construct(PRedis $redis)
    {
        $this->redis = $redis->connection();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projectKeys = $this->redis->keys($this->projectHashKey . ':*');

        foreach ($projectKeys as $projectKey) {
            $key = explode(':', $projectKey)[1];
            $projects[$key] = $this->redis->hgetall($projectKey);
        }

        return view('projects/index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('projects/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $inputs = $request->except(['_token']);

        $projectName = $this->projectHashKey . ':' . rand();

        foreach ($inputs as $key => $value) {
            $this->redis->hmset($projectName, $key, $value);
        }

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($projectId)
    {
        $project = $this->redis->hgetall($this->projectHashKey . ':' . $projectId);

        $project['id'] = $projectId;

        return view('projects/show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($projectId)
    {
        $project = $this->redis->hgetall($this->projectHashKey . ':' . $projectId);

        $project['id'] = $projectId;

        return view('projects/edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($projectId, Request $request)
    {
        $inputs = $request->except(['_token', '_method']);

        $projectName = $this->projectHashKey . ':' . $projectId;

        foreach ($inputs as $key => $value) {
            $this->redis->hmset($projectName, $key, $value);
        }

        return redirect("/projects/$projectId");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($projectId)
    {
        $this->redis->del($this->projectHashKey . ':' . $projectId);

        return redirect('/projects');
    }

    public function doSearch($target = null)
    {
        $projectKeys = $this->redis->keys($this->projectHashKey . ':*');

        foreach ($projectKeys as $projectKey) {
            $key = explode(':', $projectKey)[1];
            $projects[$key] = $this->redis->hgetall($projectKey);
        }

        if (empty($target)) {
            $projects = null;
        } else {
            $projects = array_slice(
                $projects,
                rand(0, count($projects)),
                rand(0, count($projects)),
                true
            );
        }

        return view('projects/search', compact('target', 'projects'));
    }

    public function search(Request $request)
    {
        $target = $request->input('target');

        return redirect("/projects/search/$target");
    }
}
