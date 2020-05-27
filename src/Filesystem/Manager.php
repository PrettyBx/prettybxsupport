<?php

declare(strict_types=1);

namespace PrettyBx\Support\Filesystem;

class Manager
{
    /**
     * file_get_contents wrapper
     *
     * @access	public
     * @param	string	$filename	
     * @param	mixed 	$data    	
     * @return	mixed
     */
    public function getContents(string $filename, $data)
    {
        return file_get_contents($filename, $data);
    }

    /**
     * file_put_contents wrapper
     *
     * @access	public
     * @param	string	$filename	
     * @param	mixed 	$data    	
     * @return	mixed
     */
    public function putContents(string $filename, $data)
    {
        return file_put_contents($filename, $data);
    }

    /**
     * rename wrapper
     *
     * @access	public
     * @param	string	$oldnam
     * @param	string	$newname
     * @return	bool
     */
    public function rename(string $oldname , string $newname): bool
    {
        return rename($oldname, $newname);
    }

    /**
     * Returns true if file exists
     *
     * @access	public
     * @param	string	$filename	
     * @return	bool
     */
    public function exists(string $filename): bool
    {
        return file_exists($filename);
    }

    /**
     * mkdir wrapper
     *
     * @access	public
     * @param	string 	$pathname 	
     * @param	integer	$mode     	Default: 0777
     * @param	boolean	$recursive	Default: false
     * @return	bool
     */
    public function mkdir(string $pathname, int $mode = 0777, bool $recursive = false): bool
    {
        return mkdir($pathname, $mode, $recursive);
    }

    /**
     * rename wrapper
     *
     * @access	public
     * @param	string  	$oldname	
     * @param	string  	$newname	
     * @param	resource	$context	
     * @return	bool
     */
    public function rename(string $oldname, string $newname, resource $context = null): bool
    {
        return rename($oldname, $newname, $context);
    }
}