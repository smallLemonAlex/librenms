<?php
/**
 * powerwalker.inc.php
 *
 * LibreNMS runtime sensor discovery module for PowerWalker
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    LibreNMS
 * @link       http://librenms.org
 * @copyright  2016 Neil Lathwood
 * @author     Neil Lathwood <neil@lathwood.co.uk>
 */

if ($device['os'] === 'powerwalker') {
    echo("PowerWalker ");

    $descr   = 'Battery time remaining';
    $oid     = '.1.3.6.1.2.1.33.1.2.3.0';
    $value   = snmp_get($device, 'upsEstimatedMinutesRemaining.0', '-Oqv', 'UPS-MIB');
    $value   = preg_replace('/\D/', '', $value);

    if (is_numeric($value) && $value > 0) {
        discover_sensor($valid['sensor'], 'runtime', $device, $oid, 1, 'powerwalker', $descr, '1', '1', null, null, null, null, $value);
    }
}