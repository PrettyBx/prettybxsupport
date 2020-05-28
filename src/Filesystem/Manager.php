<?php

declare(strict_types=1);

namespace PrettyBx\Support\Filesystem;

use Illuminate\Support\Traits\Macroable;

class Manager
{
    use Macroable;

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

    /**
     * touch wrapper
     *
     * @access	public
     * @param	string	$filename	
     * @param	int   	$time    	Default: null
     * @param	int   	$atime   	Default: null
     * @return	bool
     */
    public function touch(string $filename, int $time = null, int $atime = null): bool
    {
        if (empty($time)) {
            $time = time();
        }

        return touch($filename, $time, $atime);
    }
}