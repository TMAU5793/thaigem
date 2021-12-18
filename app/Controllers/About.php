<?php

namespace App\Controllers;
use App\Models\BannerModel;

class About extends BaseController
{
    protected $db;
    protected $builder;
    protected $lang;
    protected $banner;
    public function __construct() {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('tbl_information');
        $bannerModel = new BannerModel();
        $this->banner = $bannerModel->where('page','about')->first();

        $this->lang = 'en';
        if(session()->get('lang')){
            $this->lang = session()->get('lang');
        }
    }
	public function index()
	{        
        $data = [
            'meta_title' => 'About US'
        ];
        
        echo view('front/about', $data);
	}

    public function history()
    {
        $query = $this->getInformation('about','1'); //page, data category
        
        $data = [
            'meta_title' => ($this->lang=='en' && $query->title_en!='' ? $query->title_en : $query->title_th),
            'lang' => $this->lang,
            'info_single' => $query,
            'banner' => $this->banner
        ];
        
        echo view('template/information', $data);
    }

    public function regulation()
    {
        $query = $this->getInformation('about','2'); //page, data category
        
        $data = [
            'meta_title' => ($this->lang=='en' && $query->title_en!='' ? $query->title_en : $query->title_th),
            'lang' => $this->lang,
            'info_single' => $query,
            'banner' => $this->banner
        ];
        
        echo view('template/information', $data);
    }

    public function advisory()
    {
        $query = $this->getInformation('about','3'); //page, data category
        
        $data = [
            'meta_title' => ($this->lang=='en' && $query->title_en!='' ? $query->title_en : $query->title_th),
            'lang' => $this->lang,
            'info_single' => $query,
            'banner' => $this->banner
        ];
        
        echo view('template/information', $data);
    }    

    public function directors()
    {
        $query = $this->getInformation('about','4'); //page, data category
        
        $data = [
            'meta_title' => ($this->lang=='en' && $query->title_en!='' ? $query->title_en : $query->title_th),
            'lang' => $this->lang,
            'info_single' => $query,
            'banner' => $this->banner
        ];
        
        echo view('template/information', $data);
    }

    public function policy()
    {
        $query = $this->getInformation('about','5'); //page, data category
        $data = [
            'meta_title' => ($this->lang=='en' && $query->title_en!='' ? $query->title_en : $query->title_th),
            'lang' => $this->lang,
            'info_single' => $query,
            'banner' => $this->banner
        ];
        
        echo view('template/information', $data);
    }

    public function getInformation($page,$cate)
    {
        $this->builder->where(['page'=>$page,'cate'=>$cate]);
        $this->builder->limit(1);
        $query = $this->builder->get()->getRow();
        return $query;
    }
}
