<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
  public function show()
  {
    return Task::all();
  }
  public function create(Request $req)
  {
    $content = $req->input('content');
    $done = $req->input('done');

    // or with syntax
    // $content = $req->content;
    // $done = $req->done;
    
    Task::insertGetId([
      'content' => $content,
      'done' => $done
    ]);
    
    return ['status' => 'success'];
  }
  public function edit(Request $req)
  {
    Task::where('id', $req->id)->update($req);
    return ['status' => 'success'];
  }
  public function destroy($id)
  {
    Task::where('id', $id)->delete();
    return ['status' => 'success'];
  }
};
