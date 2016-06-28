<?php

namespace lib\routing;

/**
 * @throws \Exception
 */
function routing_get_route_collection()
{
    static $routes = null;

    if (null === $routes) {
        $routes = \lib\conf\conf_load_configuration_file('routing', ROOT_DIRECTORY.'/config');
    }

    return $routes;
}

/**
 * Le cache apc est t-il supporté par la plateforme
 *
 * @return bool
 */
function routing_is_cache()
{
    static $apc;

    if ($apc === null) {
        $apc = (PHP_SAPI != 'cli' && extension_loaded('apc'));
    }

    return $apc;
}

/**
 * @param string     $routeName
 * @param bool|false $absolute
 * @return string
 */
function routing_generate($routeName, $absolute = false)
{
    $routeCollection = routing_get_route_collection();

    return isset($routeCollection[$routeName]) ? $routeCollection[$routeName]['path'] : '';
}

/**
 * @param string $uri
 * @return null
 */
function routing_match($uri)
{
    // On génére la clé pour la msie en cache
    $keyCache = 'routing_'.md5($uri);

    // On récupere la collection de route
    $routeCollection = routing_get_route_collection();

    // Si le nom de route est déjà en cache alors on retourne directement la route associé
    if (routing_is_cache() && apc_exists($keyCache)) {
        return $routeCollection[apc_fetch($keyCache)];
    }

    // Sinon on parcours les route à la recherche de celle dont l'url match avec l'url demandée
    foreach ($routeCollection as $routeName => $route) {

        // Une fois trouvée
        if ($uri === $route['path']) {

            // On la stocke en cache (si cache disponible sur la plateforme)
            if (routing_is_cache()) {
                apc_store($keyCache, $routeName);
            }

            // Puis on retourne la définition de cette route
            return $route;
        }
    }

    // Si on ne la trouve pas alors on retourne null
    return null;
}