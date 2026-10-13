<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

        try{
            $edit_robots = $_POST['edit_robots'];

            $robots_file = ROOTDIR .'/robots.txt';
            $result = file_exists($robots_file) ? file_put_contents($robots_file,$edit_robots) : false;

            exit( json_encode([
                'status'=> ($result ? 'success' : 'error'),
                'title'=>  ($result ? ZM_PB_ADMINLANG->other->success : ZM_PB_ADMINLANG->other->error ),
                'message' => $result,
            ]) );

        } catch (Exception $e) {
            exit( json_encode(['status'=>'error', 'title'=> ZM_PB_ADMINLANG->other->error,'message'=>ZM_PB_ADMINLANG->other->db_operation_error .': ' . $e->getMessage()]) );
        }
