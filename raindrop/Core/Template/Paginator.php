<?php

namespace Raindrop\Core\Template;

use Raindrop\Load;
use Raindrop\Core\Database\QueryBuilder;

class Paginator {

	public static function paginate($di, $model, $per_page, $p){

		$db = $di->get('db');
		$queryBuilder = new QueryBuilder();
		$sql = $queryBuilder->select()
		                    ->from(lcfirst($model))
		                    ->orderBy('id', 'DESC')
		                    ->sql();


		$models = count($db->query($sql));

		if($models > 0) {
			$pages = ceil($models / $per_page); // number of pages with distributed content

			if(!isset($p)) {
				$p = 1;
			}
			$offset = ($p-1)*$per_page;

			$sql = $queryBuilder->select()
			                    ->from(lcfirst($model))
			                    ->orderBy('id', 'DESC')
			                    ->limit($offset,$per_page)
			                    ->sql();
			$results = $db->query($sql);
			foreach($results as $result){
				$result = json_decode(json_encode($result), true);
				Theme::block($model.'-component', $result);
			}

			echo '<div id="pg-controls">';
			if($p > 2) {
				echo '<a href="/?p=1" class="pg-arrow pg-arrow-big"><<<</a>';
			}
			if($p > 1){
				$s = $p-1;
				echo '<a href="/?p='.$s.'" class="pg-arrow"><</a>';
				echo '<a href="/?p='.$s.'" class="pg-digit">'.$s.'</a>';
			}
			if($p > 0)
				echo '<a href="/?p='.$p.'" class="pg-active">'.$p.'</a>';

			if($p != $pages){
				$s = $p+1;
				echo '<a href="/?p='.$s.'" class="pg-digit">'.$s.'</a>';
				echo '<a href="/?p='.$s.'" class="pg-arrow">></a>';
			}

			if(($pages - $p) >= 2) {
				echo '<a href="/?p='.$pages.'" class="pg-arrow pg-arrow-big">>>></a>';
			}
			echo '</div>';
		}



	}

}