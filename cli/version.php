#!/usr/bin/env php
<?php
/**
 * Version correction script.
 *
 * composer.json 버전이 기준이 됩니다.
 * 추출된 기준 버전에 맞춰, 아래 파일들의 버전을 교정합니다.
 *
 * - naran-geo-ip.php
 *
 * 1. 없는 파일은 생성하지 않습니다.
 * 2. 파일 안에 버전이 명시되지 않으면 새로 만들지 않습니다.
 */

if ( 'cli' !== php_sapi_name() ) {
	exit;
}

define( 'ROOT_DIR', dirname( __DIR__ ) );


/**
 * 파일의 내용을 읽음.
 *
 * @param string $file_name
 *
 * @return string 파일 내용. 파일이 없거나 읽을 수 없으면 빈 문자열을 리턴.
 */
function get_content( string $file_name ): string {
	if ( file_exists( $file_name ) && is_readable( $file_name ) ) {
		return file_get_contents( $file_name );
	} else {
		return '';
	}
}

/**
 * 주석에서 버전 문자열을 추출.
 *
 * @param string $content 내용.
 *
 * @return array
 */
function detect_comment( string $content ): array {
	if ( ! $content ) {
		return [ '', 0, 0 ];
	}

	$m = preg_match( ';/\*(.+?)\*/;ms', $content, $matches, PREG_OFFSET_CAPTURE );
	if ( ! $m ) {
		return [ '', 0, 0 ];
	}

	$headers = $matches[1][0];
	$offset  = $matches[1][1];
	$len     = 0;
	$version = '';

	if ( preg_match( '/version\s*:\s*(.+)/i', $headers, $matches, PREG_OFFSET_CAPTURE ) ) {
		$version = $matches[1][0];
		$offset  += $matches[1][1];
		$len     = strlen( $version );
	}

	return [ $version, $offset, $len ];
}

/**
 * const 선언에서 버전 문자열을 추출.
 *
 * const NGIP_VERSION 스타일로 선언해야 인식된다.
 *
 * @param string $content
 *
 * @return array
 */
function detect_version_const( string $content ): array {
	if ( ! $content ) {
		return [ '', 0, 0 ];
	}

	$version = '';
	$offset  = 0;
	$len     = 0;

	if ( preg_match( '/const\s*NGIP_VERSION\s*=\s*[\'\"](.+)[\'\"]\s*;/', $content, $matches, PREG_OFFSET_CAPTURE ) ) {
		$version = $matches[1][0];
		$offset  = $matches[1][1];
		$len     = strlen( $version );
	}

	return [ $version, $offset, $len ];
}

/**
 * JSON 파일 내부의 버전 문자열을 추출.
 *
 * @param string $content
 *
 * @return array
 */
function detect_json( string $content ): array {
	if ( ! $content ) {
		return [ '', 0, 0 ];
	}

	$version = '';
	$offset  = 0;
	$len     = 0;

	if ( preg_match( '/"version"\s*:\s*"(.+)"/i', $content, $matches, PREG_OFFSET_CAPTURE ) ) {
		$version = $matches[1][0];
		$offset  = $matches[1][1];
		$len     = strlen( $version );
	}

	return [ $version, $offset, $len ];
}

/**
 * 버전을 변경 처리.
 *
 * @param string $content
 * @param string $version
 * @param array  $match
 *
 * @return string
 */
function replace_version( string $content, string $version, array $match ): string {
	if ( $match && 3 === count( $match ) && is_int( $match[1] ) && is_int( $match[2] ) ) {
		if (
			strlen( $content ) > $match[1] + $match[2] &&
			$match[0] &&
			$match[0] === substr( $content, $match[1], $match[2] )
		) {
			$before  = substr( $content, 0, $match[1] );
			$after   = substr( $content, $match[1] + $match[2] );
			$content = $before . $version . $after;
		}
	}

	return $content;
}

/**
 * composer.json 버전을 기준으로 다른 파일의 버전 문자열을 변경 처리한다.
 */
function correct_version() {
	$files = [
		'composer.json'    => ROOT_DIR . '/composer.json',
		'naran-geo-ip.php' => ROOT_DIR . '/naran-geo-ip.php',
	];

	// composer.json version extraction.
	$composer = get_content( $files['composer.json'] );
	if ( $composer ) {
		$cv = detect_json( $composer );
		if ( ! $cv[0] ) {
			die( 'No version found in composer.json.' );
		}

		$main_file = get_content( $files['naran-geo-ip.php'] );

		if ( $main_file ) {
			// header version correction
			$hv = detect_comment( $main_file );
			if ( $hv[0] !== $cv[0] ) {
				$main_file = replace_version( $main_file, $cv[0], $hv );
			}

			// constant correction
			$const = detect_version_const( $main_file );
			if ( $const[0] !== $cv[0] ) {
				$main_file = replace_version( $main_file, $cv[0], $const );
			}

			if ( $main_file ) {
				file_put_contents( $files['naran-geo-ip.php'], $main_file );
			}
		}
	}
}

correct_version();
