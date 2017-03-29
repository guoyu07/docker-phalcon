<?php
/**
 * Created by PhpStorm.
 * User: cyberhck
 * Date: 3/27/17
 * Time: 7:40 PM
 */

namespace App\Main\Controllers;


use App\Main\Interfaces\IPost;
use Faker\Factory;

class PostsController extends Controller
{
    protected $faker;
    public function initialize(){
       $this->faker = Factory::create();
    }
    private function getPost(){
        $post = new IPost();
        $post->author = $this->faker->name;
        $post->body = $this->faker->paragraph;
        $post->title = $this->faker->sentence;
        return $post;
    }

    /**
     * @return \Phalcon\Http\Response
     * @ApiResponse IPost[]
     */
    public function get() {
        $data = [];
        for($i = 0; $i <= 20; $i++) {
            $data[] = $this->getPost();
        }
        return $this->jsonResponse($data);
    }

    /**
     * @return \Phalcon\Http\Response
     * @ApiResponse IPost
     * @ApiParam id integer
     */
    public function getById(){
        return $this->jsonResponse($this->getPost());
    }
    public function store(){}
    public function update(){}
    public function remove(){}
}