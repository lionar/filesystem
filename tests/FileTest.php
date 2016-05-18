<?php

namespace Lionar\FileSystem\Tests;

use 	Lionar\FileSystem\File,
	Lionar\Testing\TestCase;

class FileTest extends TestCase
{
	private $file = null;
	private $path, $extension = '';

	public function setUp (  )
	{
		$this->path = 'directory/file.txt';
		$this->extension = 'txt';
		$this->file = new File ( $this->path );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @dataProvider nonStringValues
	 */
	public function __construct_withNonStringValueForPath_throwsException ( $value )
	{
		$file = new File ( $value );
	}

	/**
	 * @test
	 */
	public function __construct_withValidPathValue_setsPathOnTheFile (  )
	{
		assertThat( $this->file->path, is ( identicalTo ( $this->path ) ) );
	}

	/**
	 * @test
	 */
	public function __construct_withValidPathValue_setsExtensionOnTheFile (  )
	{
		assertThat( $this->file->extension, is ( identicalTo ( $this->extension ) ) );
	}

	/**
	 * @test
	 */
	public function __construct_withArrayForContent_setsArrayAsContentOntoFileObject (  )
	{
		$contents = array( 'my content', 'my second line of content' );
		$file = new File ( 'directory/file', $contents );
		assertThat ( $file->contents, is ( identicalTo ( $contents ) ) );
	}

	/**
	 * @test
	 */
	public function __construct_withSingleValueForContent_setsSingleValueInArrayAsContentOntoFileObject (  )
	{
		$contents = 'my content';
		$file = new File ( 'directory/file', $contents );
		assertThat ( $file->contents, is ( arrayContaining ( $contents ) ) );
	}

	/**
	 * @test
	 */
	public function append_withArrayForContent_addsArrayAsContentOntoFileObject (  )
	{
		$contents = array( 'my content', 'my second line of content' );
		$file = new File ( 'directory/file', 'initial content' );
		$file->append ( $contents );
		assertThat ( $file->contents, is ( arrayContaining ( array ( 'initial content', 'my content', 'my second line of content' ) ) ) );
	}

	/**
	 * @test
	 */
	public function append_withSingleValueForContent_setsSingleValueInArrayAsContentOntoFileObject (  )
	{
		$contents = 'my content';
		$file = new File ( 'directory/file', 'initial content' );
		$file->append ( $contents );
		assertThat ( $file->contents, is ( arrayContaining ( array ( 'initial content', 'my content' ) ) ) );
	}

	/**
	 * @test
	 */
	public function __toString_whenAValidPathHasBeenSet_returnsTheFilePath (  )
	{
		assertThat( $this->file->__toString( ), is ( identicalTo ( $this->path ) ) );
	}
}