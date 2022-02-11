<?php

/**
 * Validation language strings.
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014-2019 British Columbia Institute of Technology
 * Copyright (c) 2019-2020 CodeIgniter Foundation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    CodeIgniter
 * @author     CodeIgniter Dev Team
 * @copyright  2019-2020 CodeIgniter Foundation
 * @license    https://opensource.org/licenses/MIT	MIT License
 * @link       https://codeigniter.com
 * @since      Version 4.0.0
 * @filesource
 *
 * @codeCoverageIgnore
 */

return [
	// Core Messages
   'noRuleSets'            => 'No s\'han definit les regles a la configuració de validació.',
   'ruleNotFound'          => '{0} no és una regla de validació vàlida.',
   'groupNotFound'         => '{0} no és un grup de regles de validació.',
   'groupNotArray'         => '{0} el grup de validació debe ser un array.',
   'invalidTemplate'       => '{0} no es un modelo de validación válido.',

	// Rule Messages
   'alpha'                 => 'El camp {field} només pot tenir caracters alfabètics.',
   'alpha_dash'            => 'El camp {field} només pot tenir caracters alfanumèrics, guió baix, i guions.',
   'alpha_numeric'         => 'El camp {field} només pot tenir caracters alfanumèrics.',
   'alpha_numeric_space'   => 'El camp {field} només pot tenir caracters alfanumèrics i espais.',
   'alpha_space'  		   => 'El camp {field} només pot tenir caracters alfabètics i espais.',
   'decimal'               => 'El camp {field} te que tenir un número decimal.',
   'differs'               => 'El camp {field} te que ser diferent de {param}.',
   'equals'                => 'El camp {field} te que ser igual a : {param}.',
   'exact_length'          => 'El camp {field} te que tenir  {param} caracters de llongitud.',
   'greater_than'          => 'El camp {field} te que ser més gran que  {param}.',
   'greater_than_equal_to' => 'El camp {field} te que ser un número més gran o igual que {param}.',
   'hex'                   => 'El camp {field} només pot contenir caracters hexadecimals.',
   'in_list'               => 'El camp {field} te que ser un de: {param}.',
   'integer'               => 'El camp {field} te que ser un número enter.',
   'is_natural'            => 'El camp {field} te que tenir només dígits.',
   'is_natural_no_zero'    => 'El camp {field} te que tenir només dígits i ser més gran que zero.',
   'is_not_unique'         => 'El camp {field} te que ser un valor coincident amb algun existent a la BBDD.',
   'is_unique'             => 'El camp {field} te que ser un valor únic.',
   'less_than'             => 'El camp {field} te que ser un número menor que {param}.',
   'less_than_equal_to'    => 'El camp {field} te que ser un número menor o igual a {param}.',
   'matches'               => 'El camp {field} no coincideix amb el campo {param}.',
   'max_length'            => 'El camp {field} no pot excedir dels {param} caracters de llongitud.',
   'min_length'            => 'El camp {field} te que tenir almenys {param} caracters de llongitud.',
   'not_equals'            => 'El camp {field} no pot ser: {param}.',
   'numeric'               => 'El camp {field} te que tenir només números.',
   'regex_match'           => 'El camp {field} no está en el format correcte.',
   'required'              => 'El camp {field} és obligatori.',
   'required_with'         => 'El camp {field} és obligatori quan {param} és present.',
   'required_without'      => 'El camp {field} és obligatori quan {param} no hi és present.',
   'timezone'              => 'El camp {field} te que ser una zona horària vàlida.',
   'valid_base64'          => 'El camp {field} te que ser una cadena base64 vàlida.',
   'valid_email'           => 'El camp {field} te que ser una adressa de email vàlida.',
   'valid_emails'          => 'El camp {field} te que contenir totes las adresses de email vàlidas.',
   'valid_ip'              => 'El camp {field} te que ser una IP vàlida.',
   'valid_url'             => 'El camp {field} te que ser una URL vàlida.',
   'valid_date'            => 'El camp {field} te que ser una data vàlida.',

	// Credit Cards
   'valid_cc_num'          => '{field} no parece ser un número de tarjeta de crédito válida.',

	// Files
   'uploaded'              => '{field} no es un campo de subida de archivo válido.',
   'max_size'              => '{field} es demasiado grande para un archivo.',
   'is_image'              => '{field} no es válido, subido archivo de imagen.',
   'mime_in'               => '{field} no tiene un tipo válido de mime.',
   'ext_in'                => '{field} no tiene una extensión de archivo válida.',
   'max_dims'              => '{field} no es una imagen o tiene demasiado alto o ancho.',
];
