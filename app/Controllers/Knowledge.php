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
            'info' => $model->orderby('created_at','DESC')->paginate(9),
			'pager' => $model->pager,
            'hot_article' => $model->where('hot_article','on')->orderby('created_at','DESC')->limit(3)->findAll(),
            'lang' => $this->lang
        ];

        echo view('front/knowledge', $data);
	}

    public function post()
    {
        $model = new KnowledgeModel();
        $uri = service('uri');
        $segment3 = $uri->getSegment(3);

        $row = $model->where('slug',$segment3)->first();
        if(!$row){
            $row = $model->where('id',$segment3)->first();
        }
        
        $data = [
            'meta_title' => ($this->lang=='en' && $row['meta_title_en']!=""?$row['meta_title_en']:$row['meta_title']),
            'meta_desc' => ($this->lang=='en' && $row['meta_desc_en']!=""?$row['meta_desc_en']:$row['meta_desc']),
            'info' => $row
        ];
        
        echo view('front/knowledge-desc', $data);
    }
}
