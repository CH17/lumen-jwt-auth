<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CategoryTest extends TestCase {


    /*********************************************
     * @Prams
     * RETURN
     */
    
    public function test_it_should_return_all_categories(){
        
        $this->get("api/v1/categories");
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'name',
                    'parent_id',
                    'created_at',
                    'updated_at',
                    'childs'
                ]
            ]
        ]);
        
    }

    public function test_it_should_create_category(){

        $data = [
            'name' => 'Black',
            'parent_id' => 0,
        ];
        $category  = $this->post("api/v1/categories", $data, []);

        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'name',
                'parent_id',
                'created_at',
                'updated_at'
            ]
                
        );
        
    }

    public function test_it_should_delete_category(){
        
       $category = factory('App\Category')->create();
       
       $this->json('DELETE', 'api/v1/categories/'.$category->id);
       $this->seeStatusCode(200);
       $this->notSeeInDatabase('categories', ['id' => $category->id]);
    }
}