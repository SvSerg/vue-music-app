<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Stream;

class StreamController extends Controller {
	/*
	* Get stream items
	*/
	public function get(Request $request) {
		$post = Stream::orderBy('id', 'desc')->get();
		return response()->json($post);
	}

	/*
	* SEARCH STREAM ITEMS FROM REQUEST
	*/
	public function search(Request $request) {
    $this->validate($request, [
      'search' => 'required|max:255',
    ]);
		$items = Stream::orderBy('id', 'desc')
			->where('performer', 'LIKE', '%'.$request->input('search').'%')
			->orWhere('track_name', 'LIKE', '%'.$request->input('search').'%')
			->get();
		return response()->json($items);
	}

	public function countSearch(Request $request) {
    $this->validate($request, [
      'search' => 'required|max:255',
    ]);
		$items = Stream::where('performer', 'LIKE', '%'.$request->input('search').'%')
			->orWhere('track_name', 'LIKE', '%'.$request->input('search').'%')
			->count();
		return response()->json($items);
	}
}
