<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage BUZZSTONE
 * @since BUZZSTONE 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) {
	exit; }

// Get theme variable
if ( ! function_exists( 'buzzstone_storage_get' ) ) {
	function buzzstone_storage_get( $var_name, $default = '' ) {
		global $BUZZSTONE_STORAGE;
		return isset( $BUZZSTONE_STORAGE[ $var_name ] ) ? $BUZZSTONE_STORAGE[ $var_name ] : $default;
	}
}

// Set theme variable
if ( ! function_exists( 'buzzstone_storage_set' ) ) {
	function buzzstone_storage_set( $var_name, $value ) {
		global $BUZZSTONE_STORAGE;
		$BUZZSTONE_STORAGE[ $var_name ] = $value;
	}
}

// Check if theme variable is empty
if ( ! function_exists( 'buzzstone_storage_empty' ) ) {
	function buzzstone_storage_empty( $var_name, $key = '', $key2 = '' ) {
		global $BUZZSTONE_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return empty( $BUZZSTONE_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return empty( $BUZZSTONE_STORAGE[ $var_name ][ $key ] );
		} else {
			return empty( $BUZZSTONE_STORAGE[ $var_name ] );
		}
	}
}

// Check if theme variable is set
if ( ! function_exists( 'buzzstone_storage_isset' ) ) {
	function buzzstone_storage_isset( $var_name, $key = '', $key2 = '' ) {
		global $BUZZSTONE_STORAGE;
		if ( ! empty( $key ) && ! empty( $key2 ) ) {
			return isset( $BUZZSTONE_STORAGE[ $var_name ][ $key ][ $key2 ] );
		} elseif ( ! empty( $key ) ) {
			return isset( $BUZZSTONE_STORAGE[ $var_name ][ $key ] );
		} else {
			return isset( $BUZZSTONE_STORAGE[ $var_name ] );
		}
	}
}

// Inc/Dec theme variable with specified value
if ( ! function_exists( 'buzzstone_storage_inc' ) ) {
	function buzzstone_storage_inc( $var_name, $value = 1 ) {
		global $BUZZSTONE_STORAGE;
		if ( empty( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = 0;
		}
		$BUZZSTONE_STORAGE[ $var_name ] += $value;
	}
}

// Concatenate theme variable with specified value
if ( ! function_exists( 'buzzstone_storage_concat' ) ) {
	function buzzstone_storage_concat( $var_name, $value ) {
		global $BUZZSTONE_STORAGE;
		if ( empty( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = '';
		}
		$BUZZSTONE_STORAGE[ $var_name ] .= $value;
	}
}

// Get array (one or two dim) element
if ( ! function_exists( 'buzzstone_storage_get_array' ) ) {
	function buzzstone_storage_get_array( $var_name, $key, $key2 = '', $default = '' ) {
		global $BUZZSTONE_STORAGE;
		if ( empty( $key2 ) ) {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $BUZZSTONE_STORAGE[ $var_name ][ $key ] ) ? $BUZZSTONE_STORAGE[ $var_name ][ $key ] : $default;
		} else {
			return ! empty( $var_name ) && ! empty( $key ) && isset( $BUZZSTONE_STORAGE[ $var_name ][ $key ][ $key2 ] ) ? $BUZZSTONE_STORAGE[ $var_name ][ $key ][ $key2 ] : $default;
		}
	}
}

// Set array element
if ( ! function_exists( 'buzzstone_storage_set_array' ) ) {
	function buzzstone_storage_set_array( $var_name, $key, $value ) {
		global $BUZZSTONE_STORAGE;
		if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$BUZZSTONE_STORAGE[ $var_name ][] = $value;
		} else {
			$BUZZSTONE_STORAGE[ $var_name ][ $key ] = $value;
		}
	}
}

// Set two-dim array element
if ( ! function_exists( 'buzzstone_storage_set_array2' ) ) {
	function buzzstone_storage_set_array2( $var_name, $key, $key2, $value ) {
		global $BUZZSTONE_STORAGE;
		if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = array();
		}
		if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ][ $key ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ][ $key ] = array();
		}
		if ( '' === $key2 ) {
			$BUZZSTONE_STORAGE[ $var_name ][ $key ][] = $value;
		} else {
			$BUZZSTONE_STORAGE[ $var_name ][ $key ][ $key2 ] = $value;
		}
	}
}

// Merge array elements
if ( ! function_exists( 'buzzstone_storage_merge_array' ) ) {
	function buzzstone_storage_merge_array( $var_name, $key, $value ) {
		global $BUZZSTONE_STORAGE;
		if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			$BUZZSTONE_STORAGE[ $var_name ] = array_merge( $BUZZSTONE_STORAGE[ $var_name ], $value );
		} else {
			$BUZZSTONE_STORAGE[ $var_name ][ $key ] = array_merge( $BUZZSTONE_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Add array element after the key
if ( ! function_exists( 'buzzstone_storage_set_array_after' ) ) {
	function buzzstone_storage_set_array_after( $var_name, $after, $key, $value = '' ) {
		global $BUZZSTONE_STORAGE;
		if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			buzzstone_array_insert_after( $BUZZSTONE_STORAGE[ $var_name ], $after, $key );
		} else {
			buzzstone_array_insert_after( $BUZZSTONE_STORAGE[ $var_name ], $after, array( $key => $value ) );
		}
	}
}

// Add array element before the key
if ( ! function_exists( 'buzzstone_storage_set_array_before' ) ) {
	function buzzstone_storage_set_array_before( $var_name, $before, $key, $value = '' ) {
		global $BUZZSTONE_STORAGE;
		if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = array();
		}
		if ( is_array( $key ) ) {
			buzzstone_array_insert_before( $BUZZSTONE_STORAGE[ $var_name ], $before, $key );
		} else {
			buzzstone_array_insert_before( $BUZZSTONE_STORAGE[ $var_name ], $before, array( $key => $value ) );
		}
	}
}

// Push element into array
if ( ! function_exists( 'buzzstone_storage_push_array' ) ) {
	function buzzstone_storage_push_array( $var_name, $key, $value ) {
		global $BUZZSTONE_STORAGE;
		if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = array();
		}
		if ( '' === $key ) {
			array_push( $BUZZSTONE_STORAGE[ $var_name ], $value );
		} else {
			if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ][ $key ] ) ) {
				$BUZZSTONE_STORAGE[ $var_name ][ $key ] = array();
			}
			array_push( $BUZZSTONE_STORAGE[ $var_name ][ $key ], $value );
		}
	}
}

// Pop element from array
if ( ! function_exists( 'buzzstone_storage_pop_array' ) ) {
	function buzzstone_storage_pop_array( $var_name, $key = '', $defa = '' ) {
		global $BUZZSTONE_STORAGE;
		$rez = $defa;
		if ( '' === $key ) {
			if ( isset( $BUZZSTONE_STORAGE[ $var_name ] ) && is_array( $BUZZSTONE_STORAGE[ $var_name ] ) && count( $BUZZSTONE_STORAGE[ $var_name ] ) > 0 ) {
				$rez = array_pop( $BUZZSTONE_STORAGE[ $var_name ] );
			}
		} else {
			if ( isset( $BUZZSTONE_STORAGE[ $var_name ][ $key ] ) && is_array( $BUZZSTONE_STORAGE[ $var_name ][ $key ] ) && count( $BUZZSTONE_STORAGE[ $var_name ][ $key ] ) > 0 ) {
				$rez = array_pop( $BUZZSTONE_STORAGE[ $var_name ][ $key ] );
			}
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if ( ! function_exists( 'buzzstone_storage_inc_array' ) ) {
	function buzzstone_storage_inc_array( $var_name, $key, $value = 1 ) {
		global $BUZZSTONE_STORAGE;
		if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = array();
		}
		if ( empty( $BUZZSTONE_STORAGE[ $var_name ][ $key ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ][ $key ] = 0;
		}
		$BUZZSTONE_STORAGE[ $var_name ][ $key ] += $value;
	}
}

// Concatenate array element with specified value
if ( ! function_exists( 'buzzstone_storage_concat_array' ) ) {
	function buzzstone_storage_concat_array( $var_name, $key, $value ) {
		global $BUZZSTONE_STORAGE;
		if ( ! isset( $BUZZSTONE_STORAGE[ $var_name ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ] = array();
		}
		if ( empty( $BUZZSTONE_STORAGE[ $var_name ][ $key ] ) ) {
			$BUZZSTONE_STORAGE[ $var_name ][ $key ] = '';
		}
		$BUZZSTONE_STORAGE[ $var_name ][ $key ] .= $value;
	}
}

// Call object's method
if ( ! function_exists( 'buzzstone_storage_call_obj_method' ) ) {
	function buzzstone_storage_call_obj_method( $var_name, $method, $param = null ) {
		global $BUZZSTONE_STORAGE;
		if ( null === $param ) {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $BUZZSTONE_STORAGE[ $var_name ] ) ? $BUZZSTONE_STORAGE[ $var_name ]->$method() : '';
		} else {
			return ! empty( $var_name ) && ! empty( $method ) && isset( $BUZZSTONE_STORAGE[ $var_name ] ) ? $BUZZSTONE_STORAGE[ $var_name ]->$method( $param ) : '';
		}
	}
}

// Get object's property
if ( ! function_exists( 'buzzstone_storage_get_obj_property' ) ) {
	function buzzstone_storage_get_obj_property( $var_name, $prop, $default = '' ) {
		global $BUZZSTONE_STORAGE;
		return ! empty( $var_name ) && ! empty( $prop ) && isset( $BUZZSTONE_STORAGE[ $var_name ]->$prop ) ? $BUZZSTONE_STORAGE[ $var_name ]->$prop : $default;
	}
}
