<?php

/**
 * AWStats PHP Wrapper Script
 *
 * In your AWStats.conf set the following: 
 * WrapperScript="awstats.php"
 *
 * @author      Jeroen de Jong <jeroen@telartis.nl>
 * @copyright   2004-2007 Telartis BV
 * @version     1.1
 *
 * @link        http://www.telartis.nl/xcms/awstats
 * 
 * Changelog:
 * 1.0 initial version
 * 1.1 changed month param pattern
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

/**
 * The location of the AWStats script.
 */
$AWStatsFile = '/usr/local/awstats/cgi-bin/awstats.pl';


function addparam($name, $pattern, $allways = false) {
    $result = $allways ? ' -'.$name : '';
    if (isset($_GET[$name])) {
        if (preg_match($pattern, $_GET[$name])) {
            $result .= ($allways ? '' : ' -'.$name).'='.$_GET[$name];
        }
    }
    return $result;
}


$param = addparam('config',  '/^[-\.a-z0-9]+$/i');
if (!$param) die("config parameter not set!");

$param .= addparam('output', '/^[a-z0-9]+$/', true);
$param .= addparam('year',   '/^\d{4}$/');
$param .= addparam('month', '/(\d{1,2}|all)/');
$param .= addparam('lang',   '/^[a-z]{2}$/');

$pattern = '/^[^;:,`| ]+$/';
$param .= addparam('hostfilter', $pattern);
$param .= addparam('hostfilterex', $pattern);
$param .= addparam('urlfilter', $pattern);
$param .= addparam('urlfilterex', $pattern);
$param .= addparam('refererpagesfilter', $pattern);
$param .= addparam('refererpagesfilterex', $pattern);
$param .= addparam('filterrawlog', $pattern);


passthru('perl '.$AWStatsFile.$param);

?>