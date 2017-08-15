<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Stream;
use Auth;

class PlaylistController extends Controller {
	public function add(Request $request) {
		$id = $request->input('id');
		if(Auth::user()['playlist'] === null) {
			$item = [$id];
			return User::where('id', Auth::id())->update(['playlist' => json_encode($item)]);
		}
		else {
			$items = json_decode(Auth::user()['playlist']);
			//? add data on first position in massive
			array_unshift($items, $id);
			return User::where('id', Auth::id())->update(['playlist' => json_encode($items)]);
		}
	}

	public function update(Request $request) {
		$items = $request->input('playlist');
		return User::where('id', Auth::id())->update(['playlist' => json_encode($items)]);
	}

	public function getRandom(Request $request) {
		$items = Stream::inRandomOrder()->limit($request->input('limit'))->get();
		return response()->json($items);
	}

	public function get(Request $request) {
		if(Auth::user()['playlist'] !== null) {
			//? if in playlist has data
			$items = Auth::user()['playlist'];
			$items = json_decode($items);
			$result = array();
			
			$i = 0;
			foreach ($items as $key => $value) {
				// limit of items
				if($i < $request->input('limit')) {
					$i += 1;
					//! get items from db via array data
					array_push($result, Stream::where('id', [$items[$key] => $value])->get());
				}
			}
			$result = [
				'result' => $result,
				'extend' => $items,
			];
			return response()->json($result);
		}
		else {
			//? if playlist return null ..
			return response()->json([], 422);
		}
	}
}
