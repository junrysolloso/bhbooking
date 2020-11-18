<?php
/**
 * System messages translation for CodeIgniter(tm)
 *
 * @author	CodeIgniter community
 * @author	Iban Eguia
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 */
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

$lang['migration_none_found']		= 'No migration found.';
$lang['migration_not_found']		= 'No migration found with version number: %s.';
$lang['migration_sequence_gap']		= 'There is a gap in the migration, near the version number: %s.';
$lang['migration_multiple_version']	= 'There are multiple migrations with the same version number: %s.';
$lang['migration_class_doesnt_exist']	= 'Migration class "%s" could not be found.';
$lang['migration_missing_up_method']	= 'Migration class "%s" is missing method "up".';
$lang['migration_missing_down_method']	= 'Migration class "%s" is missing method "down".';
$lang['migration_invalid_filename']	= 'Migration "%s" has invalid file name.';
