<?php 

namespace App\View\Helper;

use Cake\View\Helper;

class LinkHelper extends Helper
{
    public $helpers = ['Html'];
    public function makeEdit($title, $url)
    {
        $link = $this->Html->link($title, $url, ['class' => 'edit']);

        return '<div class="editOuter">' . $link . '</div>';
    }

    public function test($title) {
        return '<div>' . $title . '</div>';
    }

    public function changeLangByFlag($lang) {
        return $this->Html->image('lang_' . $lang . '.svg', [
            "height" => "20",
            "width" => "30",
            "alt" => $lang,
            'url' => ['controller' => 'App', 'action' => 'change-language', $lang]
        ]);
    }
}