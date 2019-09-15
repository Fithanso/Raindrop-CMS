<?php
/**
 * Created by PhpStorm.
 * User: Fithanso
 * Date: 14.05.2019
 * Time: 11:41
 */

namespace Raindrop\Admin\Controller;

use Raindrop\Controller;
use Raindrop\DI\DI;
use Raindrop\Core\Auth\Auth;
use Raindrop\Core\Database\QueryBuilder;

class LoginController extends Controller {

	protected $auth;
	/**
	 * LoginController constructor.
	 *
	 * @param DI $di
	 */
	public function __construct( DI $di ) {
		parent::__construct( $di );

		$this->auth = new Auth();

		if($this->auth->hashUser() !== null) {
			header('Location: /admin/');
			exit();
		}

	}

	public function form() {

		if ( $this->auth->authorized() ) {
			exit();
		}

		$this->view->render( 'login' );
	}

	public function authAdmin() {
		$params = $this->request->post;

		$queryBuilder = new QueryBuilder();

		$sql = $queryBuilder
			->select()
			->from('user')
			->where('email', $params['email'])
			->where('password',md5($params['password']))
			->limit(1)
			->sql();

		$query = $this->db->query($sql, $queryBuilder->values);

		if(!empty($query)) {
			$user = $query[0];

			if($user->role == 'admin') {
				$hash = md5($user->id . $user->email . $user->password . $this->auth->salt());

				$sql = $queryBuilder
					->update('user')
					->set(['hash' => $hash])
					->where('id', $user->id)
					->sql();


				$this->db->execute($sql, $queryBuilder->values);

				$this->auth->authorize($hash);
				header('Location: /admin/');
				exit();
			}
		}else{
			echo 'Incorrect email or password';
		}

	}

}