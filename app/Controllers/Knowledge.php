<?php

namespace App\Controllers;
use App\Models\KnowledgeModel;

class Knowledge extends BaseController
{
    protected $lang;
    public function __construct() {
        $this->lang = session()->get('lang');
        if($this->lang==''){
            $this->lang = 'en';
        }
    }

	public function index()
	{
        $model = new KnowledgeModel();
        
        $data = [
            'meta_title' => 'Knowledge',
            'info' => $model->where('status','on')->orderby('created_at','DESC')->paginate(9),
			'pager' => $model->pager,
            'hot_article' => $model->where('hot_article','on')->orderby('created_at','DESC')->findAll(3),
            'lang' => $this->lang
        ];

        echo view('front/knowledge', $data);
	}

    public function post()
    {
        $model = new KnowledgeModel();
        $uri = service('uri');
        $segment3 = $uri->getSegment(3);
        $segment3 = urldecode($segment3);

        $row = $model->where('slug',$segment3)->first();
        $tags = explode(',',$row['tags']);
        $related = [];
        $n=0;
        foreach ($tags as $tag){
            if($n<3){
                $related = $model->like('tags',$tag)->where('id !=',$row['id'])->orderBy('created_at DESC')->findAll(3);
            }
        }
        if(!$row){
            $row = $model->where('id',$segment3)->first();
            $sql = "UPDATE tbl_articles SET view=view+1 WHERE id = '$segment3'";
            $model->query($sql);
        }else{
            $sql = "UPDATE tbl_articles SET view=view+1 WHERE slug = '$segment3'";
            $model->query($sql);
        }
        
        $data = [
            'meta_title' => ($this->lang=='en' && $row['meta_title_en']!=""?$row['meta_title_en']:$row['meta_title']),
            'meta_desc' => ($this->lang=='en' && $row['meta_desc_en']!=""?$row['meta_desc_en']:$row['meta_desc']),
            'info' => $row,
            'lang' => $this->lang,
            'related' => $related,
            'shareImg' => $row['thumbnail']
        ];
        
        //print_r($related);
        echo view('front/knowledge-desc', $data);
    }
}
