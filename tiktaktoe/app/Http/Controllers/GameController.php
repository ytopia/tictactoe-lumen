<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Log;
use App\Models\Tictactoe;
use Illuminate\Http\Request;

/**
 * Class GameController
 * @package App\Http\Controllers
 */
class GameController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'uid_x' => 'required|integer|min:1',
            'uid_o' => 'required|integer|min:1|different:uid_x',
        ]);
        $game = new Game;
        $game->uid_x = $request->uid_x;
        $game->uid_o = $request->uid_o;
        $game->save();
        return response()->json($game);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:games,id',
        ]);
        $game = Game::find($request['id']);
        return response()->json($game);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer|exists:games,id',
            'step' => 'required|integer|digits_between:1,9',
            'uid' => 'required|integer|min:1',
        ]);
        $game= Game::find($request['id']);
        $step = $request->input('step');
        $uid = $request->input('uid');

        $tiktactoe =new Tictactoe;
        try {
            $result = $tiktactoe->checkWin($game, $uid, $step);
        }
        catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], 422);
        }
        $field= 'field'.$step;
        $game->$field = $result['is_x'];
        $game->result = $result['result'];
        $game->last_uid = $uid;
        $game->save();

        $gamelog = new Log;
        $gamelog->uid = $uid;
        $gamelog->move = $step;
        $gamelog->id_game = $game->id;
        $gamelog->is_x = $result['is_x'];
        $gamelog->save();

        return response()->json($game);
    }
}
