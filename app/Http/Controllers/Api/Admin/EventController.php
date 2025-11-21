<?php 

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event; // 既存のイベントモデル

class EventController extends Controller
{
  public function store(Request $req) {
    $data = $req->validate([
      'name'         => 'required|string|max:255',
      'organization' => 'required|in:FWJ,JBBF,IFBB',
      'start_date'   => 'required|date',
      'end_date'     => 'nullable|date|after_or_equal:start_date',
      'location'     => 'nullable|string|max:255',
      'official_url' => 'nullable|url',
      'is_published' => 'boolean',
      'participants' => 'array',          // ["name","name",...]
      'participants.*' => 'string|max:100',
    ]);
    $event = Event::create($data);
    return response()->json($event, 201);
  }
}
