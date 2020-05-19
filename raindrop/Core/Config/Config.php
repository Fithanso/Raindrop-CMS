<?php

namespace Raindrop\Core\Config;

/**
 * Class Config and its Repository is used to load and retrieve themes' config files
 * @package Engine\Core\Config
 */
class Config
{

    /**
     * Retrieves a config item.
     *
     * @param  string  $key
     * @param  string  $group
     * @return mixed
     */
    public static function item($key, $group = 'main')
    {
        if (!Repository::retrieve($group, $key)) {
            self::file($group);
        }

        return Repository::retrieve($group, $key);
    }

    /**
     * Retrieves a group config items.
     *
     * @param  string  $group  The item group.
     * @return mixed
     */
    public static function group($group)
    {
        if (!Repository::retrieveGroup($group)) {
            self::file($group);
        }

        return Repository::retrieveGroup($group);
    }

    /**
     * @param string $group
     * @return bool
     * @throws \Exception
     */
    public static function file($group = 'main')
    {
        $path = path('config') . DIRECTORY_SEPARATOR . $group . '.json';

        // Check that the file exists before we attempt to load it.
        if (file_exists($path)) {
            // Get items from the file.
	        $json = file_get_contents($path);
	        $d = json_decode($json);
	        $items = json_decode(json_encode($d), true);

            // Items must be an array.
            if (is_array($items)) {
                // Store items.
                foreach ($items as $key => $value) {
                    Repository::store($group, $key, $value);
                }

                // Successful file load.
                return true;
            } else {
                throw new \Exception(
                    sprintf(
                        'Config file <strong>%s</strong> is not a valid array.',
                        $path
                    )
                );
            }
        } else {
            throw new \Exception(
                sprintf(
                    'Cannot load config from file, file <strong>%s</strong> does not exist.',
                    $path
                )
            );
        }

        // File load unsuccessful.
        return false;
    }

}
