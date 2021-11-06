<?php
/**
 * @noinspection PhpIllegalPsrClassPathInspection
 * @noinspection PhpMultipleClassDeclarationsInspection
 */


/**
 * Class Updater
 */
class Test_Updater extends WP_UnitTestCase {
	public function test_decompress() {
		if ( ! extension_loaded( 'Phar' ) ) {
			$this->markTestIncomplete( 'Phar extension not found.' );
		}

		$path = __DIR__ . '/uploads';

		if ( ! file_exists( $path ) ) {
			mkdir( $path );
		}
		if ( file_exists( $path . '/test.tar' ) ) {
			unlink( $path . '/test.tar' );
		}
		if ( file_exists( $path . '/test.tar' ) ) {
			unlink( $path . '/test.tar' );
		}
		if ( file_exists( $path . '/test.tar.gz' ) ) {
			unlink( $path . '/test.tar.gz' );
		}

		// .tar.gz compression test.
		$timestamp = time();

		file_put_contents( $path . '/readme.txt', 'Timestamp: ' . $timestamp . PHP_EOL );
		file_put_contents( $path . '/hello.txt', 'Hello, World! ' . $timestamp . PHP_EOL );

		chdir( $path );

		$phar = new PharData( $path . '/test.tar' );
		$phar->addFile( 'readme.txt' );
		$phar->addFile( 'hello.txt' );
		unset( $phar );

		unlink( $path . '/readme.txt' );
		unlink( $path . '/hello.txt' );

		// $phar->compress() works not well.
		$gzdata = gzencode( file_get_contents( $path . '/test.tar' ), 9 );
		file_put_contents( $path . '/test.tar.gz', $gzdata );
		unlink( $path . '/test.tar' );

		$this->assertFileExists( $path . '/test.tar.gz' );

		$phar = new PharData( $path . '/test.tar.gz' );
		$phar->extractTo( '.' );

		$this->assertFileExists( $path . '/readme.txt' );
		$this->assertEquals( 'Timestamp: ' . $timestamp . PHP_EOL, file_get_contents( $path . '/readme.txt' ) );

		$this->assertFileExists( $path . '/hello.txt' );
		$this->assertEquals( 'Hello, World! ' . $timestamp . PHP_EOL, file_get_contents( $path . '/hello.txt' ) );

		unlink( $path . '/readme.txt' );
		unlink( $path . '/hello.txt' );
		unlink( $path . '/test.tar.gz' );
		rmdir( $path );
	}

	public function test_replace_database() {
		$license_key = getenv( 'MAXMIND_LICENSE_KEY' );
		if ( ! $license_key ) {
			$this->markTestSkipped( 'MAXMIND_LICENSE_KEY not found.' );
		}

		$updator = ngip()->db_updator;
		$this->assertTrue( $updator->update_database( $license_key, '' ) );
	}
}
