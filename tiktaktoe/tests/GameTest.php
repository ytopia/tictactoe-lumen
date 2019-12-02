<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

/**
 * Class GameTest
 */
class GameTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetById()
    {
        $this->get("api/v1/game/?id=1");
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'field1',
                'field2',
                'field3',
                'field4',
                'field5',
                'field6',
                'field7',
                'field8',
                'field9',
                'last_uid',
                'result',
                'updated_at',
                'created_at'
            ]

        );
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetByIdFailed()
    {
        $this->get("api/v1/game/?id=-1");
        $this->seeStatusCode(422);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateGame()
    {
        $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailCreateGame1()
    {
        $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 1]);
        $this->seeStatusCode(422);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailCreateGame2()
    {
        $this->post("api/v1/game", ['uid_x' => -1, 'uid_o' => 1]);
        $this->seeStatusCode(422);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailCreateGame3()
    {
        $this->post("api/v1/game", []);
        $this->seeStatusCode(422);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailCreateGame4()
    {
        $this->post("api/v1/game", ['uid_o' => 1]);
        $this->seeStatusCode(422);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFailCreateGame5()
    {
        $this->post("api/v1/game", ['uid_x' => 1.1, 'uid_o' => 1.5]);
        $this->seeStatusCode(422);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoveGame()
    {
        $json = $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2])->response->getContent();
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
        $info = json_decode($json, true);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 1, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'field1',
                'field2',
                'field3',
                'field4',
                'field5',
                'field6',
                'field7',
                'field8',
                'field9',
                'last_uid',
                'result',
                'updated_at',
                'created_at'
            ]

        );
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 2, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'field1',
                'field2',
                'field3',
                'field4',
                'field5',
                'field6',
                'field7',
                'field8',
                'field9',
                'last_uid',
                'result',
                'updated_at',
                'created_at'
            ]

        );
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoveGameFull()
    {
        $json = $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2])->response->getContent();
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
        $info = json_decode($json, true);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 1, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 2, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 4, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 5, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 7, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 8, 'id' => $info['id']]);
        $this->seeStatusCode(422);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoveGameFull2()
    {
        $json = $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2])->response->getContent();
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
        $info = json_decode($json, true);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 2, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 1, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 4, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 3, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 6, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 5, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 7, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 8, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 9, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 8, 'id' => $info['id']]);
        $this->seeStatusCode(422);
        $this->get("api/v1/game/?id=".$info['id']);
        $this->seeStatusCode(200);
        $this->seeJsonContains(['result' => 'draw']);

    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoveGameFail()
    {
        $json = $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2])->response->getContent();
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
        $info = json_decode($json, true);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 1, 'id' => $info['id']]);
        $this->seeStatusCode(422);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoveGameFail2()
    {
        $json = $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2])->response->getContent();
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
        $info = json_decode($json, true);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 1, 'id' => $info['id']]);
        $this->seeStatusCode(422);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 1, 'id' => $info['id']]);
        $this->seeStatusCode(422);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoveGameFail3()
    {
        $json = $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2])->response->getContent();
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
        $info = json_decode($json, true);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 10, 'id' => $info['id']]);
        $this->seeStatusCode(422);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => -10, 'id' => $info['id']]);
        $this->seeStatusCode(422);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 10, 'id' => $info['id']]);
        $this->seeStatusCode(422);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => -10, 'id' => $info['id']]);
        $this->seeStatusCode(422);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoveGameFail4()
    {
        $json = $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2])->response->getContent();
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
        $info = json_decode($json, true);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 1, 'id' => $info['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 2, 'id' => $info['id']]);
        $this->seeStatusCode(422);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 1, 'id' => $info['id']]);
        $this->seeStatusCode(422);
        $this->post("api/v1/game/move", ['uid' => 3, 'step' => 1, 'id' => $info['id']]);
        $this->seeStatusCode(422);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMoveMultipleGameFull()
    {
        $json = $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2])->response->getContent();
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
        $info1 = json_decode($json, true);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 2, 'id' => $info1['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 1, 'id' => $info1['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 4, 'id' => $info1['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 3, 'id' => $info1['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 6, 'id' => $info1['id']]);
        $this->seeStatusCode(200);

        $json2 = $this->post("api/v1/game", ['uid_x' => 1, 'uid_o' => 2])->response->getContent();
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'uid_x',
                'uid_o',
                'updated_at',
                'created_at'
            ]

        );
        $info2 = json_decode($json2, true);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 2, 'id' => $info2['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 1, 'id' => $info2['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 4, 'id' => $info2['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 3, 'id' => $info2['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 6, 'id' => $info2['id']]);
        $this->seeStatusCode(200);

        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 5, 'id' => $info1['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 7, 'id' => $info1['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 8, 'id' => $info1['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 9, 'id' => $info1['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 8, 'id' => $info1['id']]);
        $this->seeStatusCode(422);
        $this->get("api/v1/game/?id=".$info1['id']);
        $this->seeStatusCode(200);
        $this->seeJsonContains(['result' => 'draw']);

        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 5, 'id' => $info2['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 7, 'id' => $info2['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 8, 'id' => $info2['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 1, 'step' => 9, 'id' => $info2['id']]);
        $this->seeStatusCode(200);
        $this->post("api/v1/game/move", ['uid' => 2, 'step' => 8, 'id' => $info2['id']]);
        $this->seeStatusCode(422);
        $this->get("api/v1/game/?id=".$info2['id']);
        $this->seeStatusCode(200);
        $this->seeJsonContains(['result' => 'draw']);

    }
}
