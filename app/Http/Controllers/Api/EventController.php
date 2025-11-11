<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // GET /api/events
    public function index(Request $request)
    {
        $query = Event::query()->where('is_published', true);

        // organization指定されたら絞り込み
        if ($request->filled('organization')) {
            $query->where('organization', $request->organization);
        }

        // month指定されたら期間絞り込み (例: ?month=2025-11)
        if ($request->filled('month')) {
            $start = $request->month . '-01';
            $end = date('Y-m-t', strtotime($start));
            $query->whereBetween('start_date', [$start, $end]);
        }

        return response()->json(
            $query->orderBy('start_date')->get()
        );
    }

    public function show($id)
    {
        $event = Event::find($id);

        if (!$event || !$event->is_published) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        return response()->json($event);
    }
    }
