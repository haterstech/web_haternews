<?php

if (!class_exists('WP_FFPC_Backend_apc')):

class WP_FFPC_Backend_apc extends WP_FFPC_Backend {

	/**
	 * init apc backend: test APC availability and set alive status
	 */
	protected  function _init () {
		/* verify apc functions exist, apc extension is loaded */
		if ( ! function_exists( 'apc_cache_info' ) ) {
			$this->log ( 'APC extension missing' );
			return false;
		}

		/* verify apc is working */
		if ( apc_cache_info("user",true) ) {
			$this->log ( 'backend OK' );
			$this->alive = true;
		}
	}

	/**
	 * health checker for APC
	 *
	 * @return boolean Aliveness status
	 *
	 */
	protected  function _status () {
		$this->status = true;
		return $this->alive;
	}

	/**
	 * get function for APC backend
	 *
	 * @param string $key Key to get values for
	 *
	 * @return mixed Fetched data based on key
	 *
	*/
	protected  function _get ( &$key ) {
		return apc_fetch( $key );
	}

	/**
	 * Set function for APC backend
	 *
	 * @param string $key Key to set with
	 * @param mixed $data Data to set
	 *
	 * @return boolean APC store outcome
	 */
	protected  function _set (  &$key, &$data, &$expire ) {
		return apc_store( $key , $data , $expire );
	}


	/**
	 * Flushes APC user entry storage
	 *
	 * @return boolean APC flush outcome status
	 *
	*/
	protected  function _flush ( ) {
		return apc_clear_cache('user');
	}

	/**
	 * Removes entry from APC or flushes APC user entry storage
	 *
	 * @param mixed $keys Keys to clear, string or array
	*/
	protected  function _clear ( &$keys ) {
		/* make an array if only one string is present, easier processing */
		if ( !is_array ( $keys ) )
			$keys = array ( $keys => true );

		foreach ( $keys as $key => $dummy ) {
			if ( ! apc_delete ( $key ) ) {
				$this->log ( sprintf( 'Failed to delete APC entry: %s', $key ), LOG_WARNING );
				//throw new Exception ( __translate__('Deleting APC entry failed with key ', $this->plugin_constant ) . $key );
			}
			else {
				$this->log ( sprintf( 'APC entry delete: %s',  $key ) );
			}
		}
	}
}

endif;
