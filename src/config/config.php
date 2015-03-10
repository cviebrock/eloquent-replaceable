<?php

/*
 * Configuration for eloquent-replaceable.
 *
 * The main array is keyed by your eloquent model names (fully namespace).
 * Each element of that array has two sub-arrays:
 *
 * The "attributes" sub-array is a key/value listing of all the attributes
 * on that model that are subject to placeholder use.  The keys are the
 * attributes names, the value is an array of possible placeholders that
 * can be used in that attribute.  The value can also be the string '*',
 * in which case all of the replacements are available in that attribute.
 *
 * The "replacements" sub-array is a key/value listing of all the placeholders
 * and their replacement values.  The keys are the placeholder names
 * (corresponding to the values in the "attributes" array above). The values
 * can either be scalar values (strings, integers, etc.) or callables
 * (closures or ['class','staticMethod'] arrays).  For scalars, it's a straight
 * replacement of the placeholder for the scalar value.  For callables,
 * the function/method should expect one parameter which is the Eloquent
 * model itself, and should return a scalar value.
 *
 * The main array can also have an entry with a key of '*'.  This represents
 * global attributes and/or replacements that apply to all Eloquent models
 * that implement eloquent-replaceable.  Model-specific settings take
 * precedence over global settings.
 */

return [

//	'*' => [
//		'attributes' => [],
//		'replacements' => [
//			'date' => strftime('%B %d, %Y'),
//		],
//	],
//
//	'My\App\User' => [
//
//		'attributes' => [
//			'meta_title' => '*',
//		],
//
//		'replacements' => [
//			'full_name' => function ($obj) {
//				return $obj->first_name . ' ' . $object->last_name;
//			},
//			'copyright' => '(c) 2015',
//		]
//
//	]

];
