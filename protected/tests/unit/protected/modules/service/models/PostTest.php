<?php

require_once dirname(__FILE__) . '/../../../../../../modules/service/models/Post.php';

class PostTest extends CDbTestCase 
{
    private $_post;

    protected function setUp()
    {
        parent::setUp();
    }

    protected function tearDown()
    {}
    
    public function testTableNameIsExist()
    {
        $this->_post = new Post;
        $this->assertEquals($this->_post->tableName(),
                            $this->_post->tableSchema->name);
    }
    
    public function testModel()
    {
        $this->_post = new Post;
        $this->assertNotEmpty($this->_post->model());
    }
    
    public function testRules()
    {
        $this->_post = new Post;
        $this->assertNotEmpty($this->_post->rules());
    }

    public function testAttributeLabels()
    {
        $this->_post = new Post;
        $this->assertNotEmpty($this->_post->attributeLabels());
    }

    public function testSearch()
    {
        $this->_post = new Post;
        $this->assertNotEmpty($this->_post->search());
    }
}