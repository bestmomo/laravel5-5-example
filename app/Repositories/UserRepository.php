<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;


class UserRepository {

	/**
	 * Get users collection paginate.
	 *
	 * @param  int   $nbrPages
	 * @param  array $parameters
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAll( $nbrPages, $parameters )
	{
		return User::with( 'ingoing' )
		           ->orderBy( $parameters['order'], $parameters['direction'] )
		           ->when( ( $parameters['role'] !== 'all' ), function ( $query ) use ( $parameters ) {
			           $query->whereRole( $parameters['role'] );
		           } )->when( $parameters['valid'], function ( $query ) {
				$query->whereValid( TRUE );
			} )->when( $parameters['confirmed'], function ( $query ) {
				$query->whereConfirmed( TRUE );
			} )->when( $parameters['new'], function ( $query ) {
				$query->has( 'ingoing' );
			} )->paginate( $nbrPages );
	}

	/**
	 * Update a user.
	 *
	 * @param  \App\Http\Requests\UserUpdateRequest $request
	 * @param  \App\Models\User                     $user
	 *
	 * @return void
	 */
	public function update( $request, $user )
	{
		$inputs = $request->all();

		if ( isset( $inputs['confirmed'] ) ) {
			$inputs['confirmed'] = TRUE;
		}

		if ( isset( $inputs['valid'] ) ) {
			$inputs['valid'] = TRUE;
		}

		$user->update( $inputs );

		if ( ! $request->has( 'new' ) && $user->ingoing ) {
			$user->ingoing->delete();
		}
	}

}
